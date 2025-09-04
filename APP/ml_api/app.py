from flask import Flask, request, jsonify
from tensorflow.keras.models import load_model
from tensorflow.keras.layers import Layer
import tensorflow as tf
import numpy as np
import cv2

app = Flask(__name__)


# Custom Layer for Dual Path
class AttentionFusionLayer(Layer):

    def __init__(self, name=None, **kwargs):
        super().__init__(name=name, **kwargs)

    def build(self, input_shape):
        c = input_shape[0][-1]
        self.W = self.add_weight(name='W',
                                 shape=(c * 2, 2),
                                 initializer='random_normal',
                                 trainable=True)
        self.b = self.add_weight(name='b',
                                 shape=(2, ),
                                 initializer='zeros',
                                 trainable=True)

    def call(self, inputs):
        x1, x2 = inputs
        score1 = tf.reduce_mean(x1, axis=[1, 2], keepdims=True)
        score2 = tf.reduce_mean(x2, axis=[1, 2], keepdims=True)
        scores = tf.concat([score1, score2], axis=-1)
        weights = tf.matmul(scores, self.W) + self.b
        weights = tf.nn.softmax(weights, axis=-1)
        return weights[..., 0:1] * x1 + weights[..., 1:2] * x2


# Load Models
colon_model = load_model(
    "dualpath_histocnn.h5",
    custom_objects={'AttentionFusionLayer': AttentionFusionLayer})

lung_model = load_model(
    "dualpath_histocnn_mc.h5",
    custom_objects={'AttentionFusionLayer': AttentionFusionLayer})


# Preprocessing Function
def preprocess_image(file, size=(224, 224)):
    img_bytes = np.frombuffer(file.read(), np.uint8)
    img = cv2.imdecode(img_bytes, cv2.IMREAD_COLOR)
    img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
    img = cv2.resize(img, size)
    img = img / 255.0

    gray = cv2.cvtColor((img * 255).astype(np.uint8), cv2.COLOR_RGB2GRAY)
    grad_x = cv2.Sobel(gray, cv2.CV_64F, 1, 0, ksize=3)
    grad_y = cv2.Sobel(gray, cv2.CV_64F, 0, 1, ksize=3)
    grad = np.sqrt(grad_x**2 + grad_y**2)
    grad = (grad / grad.max() * 255).astype(np.uint8)
    grad_img = np.stack([grad] * 3, axis=-1) / 255.0

    rgb_tensor = tf.convert_to_tensor(img[np.newaxis, ...], dtype=tf.float32)
    grad_tensor = tf.convert_to_tensor(grad_img[np.newaxis, ...],
                                       dtype=tf.float32)
    return rgb_tensor, grad_tensor


# Colon Model Prediction Route
@app.route('/colon/predict', methods=['POST'])
def predict_colon():
    if 'image' not in request.files:
        return jsonify({"error": "Image missing"}), 400

    rgb, grad = preprocess_image(request.files['image'])
    preds = colon_model.predict([rgb, grad])
    idx = int(np.argmax(preds[0]))
    labels = ['Colon_adenocarcinoma', 'Colon_benign_tissue']
    confidence_percentage = float(preds[0][idx]) * 100

    return jsonify({
        "class": labels[idx],
        "confidence": round(confidence_percentage, 2)
    })


# Lung Model Prediction Route
@app.route('/lung/predict', methods=['POST'])
def predict_lung():
    if 'image' not in request.files:
        return jsonify({"error": "Image missing"}), 400

    rgb, grad = preprocess_image(request.files['image'])
    preds = lung_model.predict([rgb, grad])
    idx = int(np.argmax(preds[0]))
    labels = [
        'Lung_adenocarcinoma', 'Lung_benign_tissue',
        'Lung_squamous_cell_carcinoma'
    ]

    confidence_percentage = float(preds[0][idx]) * 100

    return jsonify({
        "class": labels[idx],
        "confidence": round(confidence_percentage, 2)
    })


if __name__ == '__main__':
    app.run(debug=True)

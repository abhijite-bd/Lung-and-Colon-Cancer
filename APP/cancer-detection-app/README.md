
```markdown
# 🧠 Cancer Detection System (Laravel + Flask + Deep Learning)

This is a full-stack AI-powered cancer detection system. Users can upload histopathological images (e.g., lung or colon tissue) via a Laravel frontend. The images are sent to a Python Flask backend, where a deep learning model (Keras `.h5`) performs classification and returns a confidence score.

## 📁 Project Structure

```
project/
├── laravel-app/             # Laravel Frontend (Blade + TailwindCSS)
│   ├── routes/web.php
│   ├── resources/views/
│   ├── public/
│   └── .env
├── ml_api/                  # Flask Backend for ML predictions
│   ├── app.py
│   ├── model.h5             # Your trained deep learning model
│   ├── utils.py             # Image preprocessing functions
│   └── requirements.txt
```

## 🚀 Features

- ✅ Upload cancer histopathology images
- ✅ Flask backend runs prediction using Keras `.h5` model
- ✅ Returns predicted class and confidence
- ✅ Smooth UI with TailwindCSS + JavaScript animations
- ✅ HTML report generation and download
- ✅ Dynamic confidence progress bar
- ✅ Medical disclaimer included

## 🛠 Setup Instructions

### 🔵 Laravel Frontend

```bash
cd laravel-app

# Install dependencies
composer install

# Copy environment and set config
cp .env.example .env
php artisan key:generate

# Update .env
APP_URL=http://localhost:8000
FLASK_API_URL=http://127.0.0.1:5000  # Add this manually if using JS

# Start server
php artisan serve
```

### 🔴 Flask Backend

```bash
cd ml_api

# Create virtual environment (optional but recommended)
python -m venv venv
source venv/bin/activate  # or venv\Scripts\activate on Windows

# Install dependencies
pip install -r requirements.txt

# Start Flask app
python app.py
```

## 📤 API Endpoint (Flask)

| Method | URL         | Description            |
|--------|-------------|------------------------|
| POST   | `/predict`  | Predict lung cancer    |
| POST   | `/predict`  | Predict colon cancer   |

**Request:**

- FormData with key `"image"` and uploaded file

**Response:**

```json
{
  "class": "Lung_adenocarcinoma",
  "confidence": 95.32
}
```

## 📄 HTML Report Download

The system dynamically creates an HTML report summarizing:

- Prediction results
- Confidence score
- Patient info
- AI model details
- Interpretation
- Medical disclaimer

You can download the report using the **"Download Report"** button.

## ✅ Technologies Used

- **Frontend**: Laravel, Blade, Tailwind CSS, JavaScript
- **Backend**: Flask, TensorFlow/Keras
- **Image Processing**: NumPy, PIL
- **Model Format**: `.h5` (Keras)

## ⚠️ Disclaimer

> This system is for **educational and research purposes only**. It is **not a substitute** for professional medical advice, diagnosis, or treatment. All predictions must be confirmed by licensed healthcare providers.

## 📸 Example Use

1. Upload image via browser
2. Flask backend processes and predicts
3. Result displayed with animation
4. HTML report can be downloaded
5. Doctor uses result as decision aid

## 📬 Contact

For feedback or questions:

**Abhijite Barman**  
📧 [dbabhijite@gmail.com](mailto:dbabhijite@gmail.com)  
🔗 [LinkedIn](https://www.linkedin.com/in/abhijite-deb-barman-4191a2209/)
```

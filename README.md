# Laravel Vue Weather App

A simple weather application using **Laravel** for the backend API and **Vue 3 (Vite)** for the frontend. It fetches live weather data from the OpenWeather API.

The backend API is protected by **custom middleware** that requires an `X-API-KEY` for authentication and validation.

---

## How to Run Locally (Docker)

### 1. Clone the Repo
```bash
git clone https://github.com/IdanFischer/Weather-Laravel-Vue.git
cd weather-app-laravel
```
### 2. Add Environment Variables
Copy the example environment files and update them with your own values.
```bash
cp backend-laravel/.env.example backend-laravel/.env
cp vite-project/.env.example vite-project/.env
```
The only thing that should be changed in the `.env` file in the `backend-laravel` folder is the `API_KEY` and `OPEN_WEATHER_API_KEY` variables. For the `API_KEY`, you can use any random string. For the `OPEN_WEATHER_API_KEY`, you need to sign up for a free account on [OpenWeather](https://openweathermap.org/api) and get your API key.

For the `.env` file in the `vite-project` folder, you need to set the `VITE_API_URL` variable to the URL of your Laravel backend. If you're using Docker, it will be `http://localhost:8000/api`. The `VITE_API_KEY` variable should be the same as the `API_KEY` variable in the Laravel backend `.env` file.

### 3. To build the frontend project
```bash
cd vite-project
npm install
```

### 4. Building backend with Docker
```bash
cd weather-app-laravel
docker-compose up -d --build
 Laravel APP_KEY generates automatically on the first startup.
No additional manual commands are required.
If you are done using docker, run the command
docker-compose down --volumes --remove-orphans
```

### 5. Access the Application
you can access the application at `http://localhost:5173` for the frontend and `http://localhost:8000/api/weather` for the backend API.

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    public function getJWTToken(Request $request)
    {
        // This is a placeholder for JWT token generation logic
        // In a real-world scenario, you would implement proper authentication and token generation here
        return response()->json(['api_key' => env('API_KEY')]);
        
    }
    public function getWeather(Request $request)
    {
        // Log incoming request info
        Log::info('Received weather request', [
            'city' => $request->query('city')
        ]);

        $city = $request->query('city', 'London');

        $apiKey = env('OPEN_WEATHER_API_KEY');

        if (!$apiKey) {
            Log::error('Missing OPEN_WEATHER_API_KEY in environment!');
            return response()->json(['error' => 'API key missing'], 500);
        }

        try {
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            if ($response->failed()) {
                Log::error('Failed to fetch weather data', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);

                return response()->json([
                    'error' => 'Unable to fetch weather data',
                    'details' => $response->json()
                ], $response->status());
            }

            Log::info('Successfully fetched weather data', [
                'city' => $city,
                'data' => $response->json()
            ]);

            return $response->json();

        } catch (\Exception $e) {
            Log::error('Exception while fetching weather data', [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'error' => 'Internal server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

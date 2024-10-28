<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService {
  public function getWeather($lat, $lon) {
    $apiKey = config('services.openweather.api_key');
    $response = Http::get('api.openweathermap.org/data/2.5/forecast?', [
      'lat' => $lat,
      'lon' => $lon,
      'exclude' => 'minutely,hourly',
      'units' => 'metric',
      'lang' => 'ja',
      'appid' => $apiKey,
    ]);

    if ($response->successful()) {
      return $response->json();
    }

    return null;
  }
}

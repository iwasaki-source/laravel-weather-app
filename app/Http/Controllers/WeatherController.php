<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
  protected $weatherService;

  public function __construct(WeatherService $weatherService)
  {
    $this->weatherService = $weatherService;
  }

  public function show(Request $request)
  {
    $lat = $request->input('lat');
    $lon = $request->input('lon');

    if (!$lat || !$lon) {
      return response()->json(['error' => 'Latitude and Logitude are required'], 400);
    }

    $weather = $this->weatherService->getWeather($lat, $lon);

    return response()->json($weather);
  }
}

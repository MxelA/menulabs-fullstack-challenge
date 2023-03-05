<?php

namespace App\Services\WeatherApi;

use App\DTOs\WeatherServiceDto;
use App\Exceptions\WeatherApiServiceErrorException;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapApiService implements IWeatherApiService
{
    private string $apiId;
    private string $units = 'standard'; // options:	standard, metric, imperial

    /**
     * @throws WeatherApiServiceErrorException
     */
    public function __construct()
    {

        $this->apiId = env('OPEN_WEATHER_APP_ID');

        if($this->apiId == null)
            throw new WeatherApiServiceErrorException("Environment variable OPEN_WEATHER_APP_ID not set ");

        if(env('OPEN_WEATHER_UNITS'))
            $this->units = env('OPEN_WEATHER_UNITS');
    }

    /**
     * @param float $lat
     * @param float $lon
     * @return WeatherServiceDto
     * @throws WeatherApiServiceErrorException
     */
    public function getWeatherByLatLon(float $lat, float $lon): WeatherServiceDto
    {
        $response = Http::acceptJson()->get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $lat,
            'lon' => $lon,
            'units' => $this->units,
            'appid' => $this->apiId
        ]);

        if(!$response->successful())
            throw new WeatherApiServiceErrorException($response->reason(), $response->status());

        $jsonResponse = json_decode((string) $response->body());

        return new WeatherServiceDto(
            $jsonResponse->main->temp,
            $jsonResponse->main->pressure,
            $jsonResponse->main->humidity,
            $this->units,
        );
    }
}

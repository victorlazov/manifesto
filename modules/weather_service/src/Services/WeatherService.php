<?php
/**
 * @file
 * Weather service main file.
 */

namespace Drupal\weather_service\Services;

/**
 * Class WeatherService.
 */
class WeatherService {
  
  /**
   * Returns the current weather information based on the post code input
   *
   * @param $code
   *
   * @return string
   */
  public function getServiceData($code): string {
    $weather = [
      'sunny',
      'cloudy',
      'rainy'
    ];
    
    return $weather[rand(0, 2)];
  }
}
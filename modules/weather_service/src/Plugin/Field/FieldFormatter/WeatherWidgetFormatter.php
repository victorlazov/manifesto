<?php

namespace Drupal\weather_service\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\weather_service\Services\WeatherService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'weather_widget' formatter.
 *
 * @FieldFormatter(
 *   id = "weather_widget",
 *   label = @Translation("Weather widget"),
 *   field_types = {
 *     "text"
 *   }
 * )
 */
class WeatherWidgetFormatter extends FormatterBase implements ContainerFactoryPluginInterface {
  /**
   * @var WeatherService
   */
  public $weatherService;
  
  /**
   * WeatherWidgetFormatter constructor.
   *
   * @param string $plugin_id
   * @param $plugin_definition
   * @param FieldDefinitionInterface $field_definition
   * @param array $settings
   * @param string $label
   * @param string $view_mode
   * @param array $third_party_settings
   * @param $weatherService
   */
  public function __construct(string $plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, string $label, string $view_mode, array $third_party_settings, $weatherService) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    
    $this->weatherService = $weatherService;
  }
  
  /**
   * {@inheritdoc}
   *
   * @param ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return ContainerFactoryPluginInterface|WeatherWidgetFormatter
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      // Add any services you want to inject here
      $container->get('weather_service.weather_service')
    );
  }
  
  /**
   * Settings summary function.
   *
   * @return array|string[]
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays the weather widget with the field.');
    
    return $summary;
  }
  
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $weather = $this->weatherService->getServiceData([]);
    
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#markup' => $item->value,
        '#suffix' => $this->constructWeatherWidget($weather),
      ];
    }
    
    return $elements;
  }
  
  /**
   * Construct appropriate weather widget markup.
   *
   * @param $data
   *
   * @return string
   */
  public function constructWeatherWidget($data) {
    return "<p>{$data}</p>";
  }
  
}

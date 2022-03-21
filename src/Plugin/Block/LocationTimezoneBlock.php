<?php

namespace Drupal\location_timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\location_timezone\Services\TimezoneConvert;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Location & Time' block.
 *
 * @Block(
 * id = "location_timezone_block",
 * admin_label = @Translation("Location & Time"),
 * )
 */
class LocationTimezoneBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\location_timezone\Services\TimezoneConvert
   */
  protected $timezone;

  /**
   * Constructs a LocationTimezoneBlock object.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\location_timezone\Services\TimezoneConvert $time_zone_convert
   *   Custom TimezoneConvert service.
   *
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimezoneConvert $time_zone_convert) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timezone = $time_zone_convert;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('location_timezone.timezone_convert_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Function from the custom service to get the data.
    $data = $this->timezone->getCurrentDateTime();
    $return = [
     '#theme' => 'location_timezone_block',
     '#value' => $data,
     '#cache' => ['max-age' => 0]
   ];

   return $return;
  }

}

<?php

namespace Drupal\location_timezone\Services;

use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * TimezoneConvert service class for timezone conversion.
 */
class TimezoneConvert {

  /**
   * The TimezoneConvert configuration.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * Constructs a TimezoneConvert object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Config factory service.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('location_timezone_form.settings');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')->get('location_timezone_form.settings'),
    );
  }

  /**
   * Returns a structured array.
   */
  public function getCurrentDateTime() {
    $timezone = $this->config->get('timezone');
    $country = $this->config->get('country');
    $city = $this->config->get('city');
    if ($timezone == 'America/Chicago') {
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }
    elseif ($timezone == 'America/New_York') {
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }
    elseif ($timezone == 'Asia/Tokyo') {
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }
    elseif ($timezone == 'Asia/Dubai') {
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }
    elseif ($timezone == 'Asia/Kolkata') {
      $timezone = $this->config->get('timezone');
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }
    elseif ($timezone == 'Europe/Amsterdam') {
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }
    elseif ($timezone == 'Europe/Oslo') {
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }
    elseif ($timezone == 'Europe/London') {
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }
    elseif ($timezone == 0) {
      $date_today = self::getTimezoneDateTime($timezone, $country, $city);
    }

    return $date_today;
  }

  /**
   * Custom function to get a structured array with converted time.
   */
  public static function getTimezoneDateTime($timezone, $country, $city) {
    date_default_timezone_set($timezone);
    $date_today = date('d F Y - h:i A');
    $arr = [
      'country' => $country,
      'city' => $city,
      'date_today' => $date_today,
      'timezone' => $timezone,
    ];

    return $arr;
  }

}

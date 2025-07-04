<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package     Fuel
 * @version     1.9-dev
 * @author      Fuel Development Team
 * @license     MIT License
 * @copyright   2010 - 2019 Fuel Development Team
 * @link        https://fuelphp.com
 */

// Bootstrap the framework - THIS LINE NEEDS TO BE FIRST!
// VENDORPATH など、FuelPHPの基本定数がここで定義されます
require COREPATH.'bootstrap.php';

// VENDORPATH が定義された後で、Paragonie\Fuel\Binary クラスのオートロード設定を追加
\Autoloader::add_class('Paragonie\\Fuel\\Binary', VENDORPATH.'paragonie/constant_time_encoding/src/Binary.php');


// Add framework overload classes here
\Autoloader::add_classes(array(
    // Example: 'View' => APPPATH.'classes/myview.php',
));

// Register the autoloader
\Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
Fuel::$env = Arr::get($_SERVER, 'FUEL_ENV', Arr::get($_ENV, 'FUEL_ENV', getenv('FUEL_ENV') ?: Fuel::DEVELOPMENT));

// Initialize the framework with the config file.
\Fuel::init('config.php');
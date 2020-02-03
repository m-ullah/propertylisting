<?php
/**
 *
 * @author     M Ullah <jitu21@gmail.com>
 * @copyright  2019 - 2020 M Ullah
 * @license    MIT
 * @version    1.0.0
 * @link       https://github.com/m-ullah/spotahome
 * @since      File available since Release 1.0.0
 * @deprecated File deprecated in Release 2.0.0
 * @copyright  Copyright (c) 2019 M Ullah
 */

namespace SH\Framework\Infrastructure\ServiceProvider;

use SH\Framework\Extension\Slim\BootableServiceProviderInterface;
use PDO;

/**
 * Class PDOServiceProvider
 *
 * @package SH\Framework\Infrastructure\ServiceProvider
 */
class PDOServiceProvider implements BootableServiceProviderInterface
{
    private $config;

    private static $db = null;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function boot()
    {
        if (self::$db === null) {
            self::$db = new \SQLite3($this->config['db']['file'], SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        }
        return $this;
    }

    public function getConnection()
    {
        return self::$db;
    }
}

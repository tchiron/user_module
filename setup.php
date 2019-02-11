<?php

declare(strict_types = 1);

define('ROOT', realpath(__DIR__));
define('DAO', ROOT . '/dao');
define('MODEL', ROOT . '/model');
define('CONTROLLER', ROOT . '/controller');
define('VIEW', ROOT . '/view');
define('CONFIG_FILE_PATH', ROOT . '/config.ini');

include ROOT . '/vendor/autoload.php';
include ROOT . '/session.php';
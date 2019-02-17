<?php

include './../setup.php';

use dao\UserDao;
use model\User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page = 'home';
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
}

include VIEW . '/base.php';
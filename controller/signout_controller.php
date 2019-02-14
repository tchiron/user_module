<?php

use model\User;
use dao\UserDao;

include './../setup.php';

$user = User::createNullObject();
$_SESSION['user'] = $user;

$page = 'home';
include VIEW . '/base.php';
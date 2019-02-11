<?php

use model\User;

session_start();

if (!empty($_SESSION['user'])) {
    $user = new User;
    $user = $_SESSION['user'];
} else {
    $user = User::createNullObject();
    $_SESSION['user'] = $user;
}
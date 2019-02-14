<?php

include './../setup.php';

use dao\UserDao;
use model\User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page = 'home';
    include VIEW . '/index.php';
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // $pages = [
    //     'accueil' => 'home',
    //     'page2' => '2',
    //     'page3' => '3',
    //     'profil' => 'profil',
    //     'deconnexion' => 'signout',
    //     'senregistrer' => 'signup',
    //     'connexion' => 'signin'
    // ];

    $page = filter_input(INPUT_GET, 'page');

    include VIEW . '/index.php';
} else {
    include VIEW . '/index.php';
}

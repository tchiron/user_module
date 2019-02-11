<?php

use model\User;
use dao\UserDao;

include './../setup.php';

$args = [
    'pseudo' => [
        FILTER_SANITIZE_SPECIAL_CHARS,
        FILTER_FLAG_ENCODE_HIGH
    ],
    'password' => [
        FILTER_SANITIZE_SPECIAL_CHARS,
        FILTER_FLAG_ENCODE_HIGH
    ]
];
$signup_post = filter_input_array(INPUT_POST, $args);

if (empty($signup_post['pseudo'])) {
    $error_messages['pseudo'] = 'Pseudo pas glop';
}
if (empty($signup_post['password'])) {
    $error_messages['password'] = 'Password pas glop';
}
if (empty($error_messages)) {
    $signup_user = new User();
    $signup_user->setPseudo($signup_post['pseudo'])->setPassword($signup_post['password']);
    try {
        $dao = new UserDao();
        $existing_user = $dao->getUserByLogin($signup_user);
        if (!$existing_user->getId()) {
            $user = $dao->addUser($signup_user);
            $_SESSION['user'] = $user;
            $page = 'home';
        } else {
            $page = 'signup';
            $error_messages['pseudo'] = 'Pseudo déjà utilisé';
        }
    } catch (PDOException $ex) {
        $page = 'signup';
        echo $ex->getMessage();
    }
} else {
    $page = 'signup';
}

include VIEW . '/index.php';
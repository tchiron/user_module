<?php

include './../setup.php';

use model\User;
use dao\UserDao;

$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
if (empty($pseudo)) {
    $error_messages['pseudo'] = 'Pseudo pas glop';
}
if (empty($password)) {
    $error_messages['password'] = 'Password pas glop';
}
if (empty($error_messages)) {
    $signin_user = new User();
    $signin_user->setPseudo($pseudo)->setPassword($password);
    try {
        $dao = new UserDao();
        $user = $dao->getUserByLogin($signin_user);
        if (password_verify($signin_user->getPassword(), $user->getPassword())) {
            $_SESSION['user'] = $user;
            $page = 'home';
        } else {
            $user = User::createNullObject();
            $page = 'signin';
        }
    } catch (PDOException $ex) {
        $page = 'signin';
        echo $ex->getMessage();
    }
} else {
    $page = 'signin';
}

include VIEW . '/index.php';
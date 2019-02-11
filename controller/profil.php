<?php

include './../setup.php';

use model\User;
use dao\UserDao;

$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
if (empty($pseudo) || $pseudo === $user->getPseudo()) {
    $error_messages['pseudo'] = 'Pseudo pas glop ou identique à celui que vous avez déjà';
}
if (empty($password) || !password_verify($password, $user->getPassword())) {
    $error_messages['password'] = 'Password pas glop';
}

if (empty($error_messages)) {
    $update_user = new User();
    $update_user->setPseudo($pseudo)->setPassword($password);

    try {
        $dao = new UserDao();
        $existing_user = $dao->getUserByLogin($update_user);
    } catch (PDOException $ex) {
        $page = 'edit_profil';
        echo $ex->getMessage();
    }

    if (!$existing_user->getId()) {
        try {
            $dao = new UserDao();
            $dao->updateUser($update_user->setId($user->getId()));
            $user->setPseudo($update_user->getPseudo());
            $_SESSION['user'] = $user;
            $page = 'profil';
        } catch (PDOException $ex) {
            $page = 'edit_profil';
            echo $ex->getMessage();
        }
    } else {
        $error_messages['pseudo'] = 'Pseudo déjà utilisé';
        $page = 'edit_profil';
    }
} else {
    $page = 'edit_profil';
}

include VIEW . '/index.php';
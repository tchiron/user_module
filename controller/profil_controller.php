<?php

include './../setup.php';

use model\User;
use dao\UserDao;

$form = filter_input(INPUT_GET, 'form', FILTER_SANITIZE_SPECIAL_CHARS);

if ($form === 'profil') {
    $args = [
        'pseudo' => [
            'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_ENCODE_HIGH
        ],
        'email' => [
            'filter' => FILTER_VALIDATE_EMAIL
        ],
        'password' => [
            'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_ENCODE_HIGH
        ]
    ];
    $update_post = filter_input_array(INPUT_POST, $args);

    if (empty($update_post['pseudo']) || $update_post['pseudo'] === $user->getPseudo()) {
        $error_messages['pseudo'] = 'Pseudo pas glop ou identique à celui que vous avez déjà';
    }
    if (empty($update_post['email']) || $update_post['email'] === $user->getEmail()) {
        $error_messages['email'] = 'Email pas glop ou identique à celui que vous avez déjà';
    }
    if (empty($update_post['password']) || !password_verify($update_post['password'], $user->getPassword())) {
        $error_messages['password'] = 'Password pas glop';
    }

    if (!isset($error_messages['password']) && (empty($error_messages['pseudo']) || empty($error_messages['email']))) {
        $update_user = new User();
        $update_user->setPseudo($update_post['pseudo'])->setEmail($update_post['email']);

        try {
            $dao = new UserDao();
            $existing_pseudo = $dao->getUserByPseudo($update_user);
            $existing_email = $dao->getUserByEmail($update_user);

            if ((!$existing_pseudo->getId() || $existing_pseudo->getId() === $user->getId()) && (!$existing_email->getId() || $existing_email->getId() === $user->getId())) {
                $dao->updateUser($update_user->setId($user->getId()));
                $user->setPseudo($update_user->getPseudo())->setEmail($update_user->getEmail());
                $_SESSION['user'] = $user;
                $page = 'profil';
            } else {
                if ($existing_pseudo->getId()) {
                    $error_messages['pseudo'] = 'Pseudo déjà utilisé';
                }
                if ($existing_email->getId()) {
                    $error_messages['email'] = 'Email déjà utilisé';
                }
                $page = 'edit_profil';
            }
        } catch (PDOException $ex) {
            $page = 'edit_profil';
            echo $ex->getMessage();
        }
    } else {
        $page = 'edit_profil';
    }
} elseif ($form === 'password') {
    $args = [
        'old_password' => [
            'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_ENCODE_HIGH
        ],
        'new_password' => [
            'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_ENCODE_HIGH
        ],
        'confirm_password' => [
            'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_ENCODE_HIGH
        ]
    ];
    $update_post = filter_input_array(INPUT_POST, $args);

    if (empty($update_post['old_password']) || !password_verify($update_post['old_password'], $user->getPassword())) {
        $error_messages['old_password'] = 'Password pas glop';
    }
    if (empty($update_post['new_password'])) {
        $error_messages['new_password'] = 'Password pas glop';
    }
    if (empty($update_post['confirm_password'])) {
        $error_messages['confirm_password'] = 'Password pas glop';
    }

    if (empty($error_messages)) {
        if ($update_post['new_password'] === $update_post['confirm_password']) {
            try {
                $update_user = new User();
                $update_user->setId($user->getId())->setPassword(password_hash($update_post['new_password'], PASSWORD_DEFAULT));
                $dao = new UserDao();
                $dao->updatePassword($update_user);
                $user->setPassword($update_user->getPassword());
                $_SESSION['user'] = $user;
                $page = 'profil';
            } catch (PDOException $ex) {
                $page = 'edit_password';
                echo $ex->getMessage();
            }
        } else {
            $error_messages['confirm_password'] = 'Password 2 pas glop';
            $page = 'edit_password';
        }
    } else {
        $page = 'edit_password';
    }
}
include VIEW . '/base.php';
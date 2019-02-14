<?php

include './../setup.php';

use model\User;
use dao\UserDao;

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
            $dao = new UserDao();
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

include VIEW . '/index.php';
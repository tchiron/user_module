<?php

use model\User;
use dao\UserDao;

include './../setup.php';

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
$signup_post = filter_input_array(INPUT_POST, $args);

if (empty($signup_post['pseudo'])) {
    $error_messages['pseudo'] = 'Pseudo pas glop';
}
if (empty($signup_post['email'])) {
    $error_messages['email'] = 'Email pas glop';
}
if (empty($signup_post['password'])) {
    $error_messages['password'] = 'Password pas glop';
}

if (empty($error_messages)) {
    $signup_user = new User();
    $signup_user->setPseudo($signup_post['pseudo'])->setEmail($signup_post['email'])->setPassword($signup_post['password']);
    
    try {
        $dao = new UserDao();
        $existing_pseudo = $dao->getUserByPseudo($signup_user);
        $existing_email = $dao->getUserByEmail($signup_user);
        
        if (!$existing_pseudo->getId() && !$existing_email->getId()) {
            $user = $dao->addUser($signup_user);
            $_SESSION['user'] = $user;
            $page = 'home';
        } else {
            if ($existing_pseudo->getId()) {
                $error_messages['pseudo'] = 'Pseudo déjà utilisé';
            }
            if ($existing_email->getId()) {
                $error_messages['email'] = 'Email déjà utilisé';
            }
            $page = 'signup';
        }
    } catch (PDOException $ex) {
        $page = 'signup';
        echo $ex->getMessage();
    }
} else {
    $page = 'signup';
}

include VIEW . '/base.php';
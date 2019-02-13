<?php

include './../setup.php';

use model\User;
use dao\UserDao;

$args = [
    'login' => [
        'filter' => FILTER_VALIDATE_EMAIL
    ],
    'password' => [
        'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
        'flags' => FILTER_FLAG_ENCODE_HIGH
    ]
];
$signin_post = filter_input_array(INPUT_POST, $args);
$login = 'email';

if (empty($signin_post['login'])) {
    $login = 'pseudo';
    $args = [
        'login' => [
            'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_ENCODE_HIGH
        ],
        'password' => [
            'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_ENCODE_HIGH
        ]
    ];
    $signin_post = filter_input_array(INPUT_POST, $args);

    if (empty($signin_post['login'])) {
        $error_messages['login'] = 'Login pas glop';
    }
}
if (empty($signin_post['password'])) {
    $error_messages['password'] = 'Password pas glop';
}

if (empty($error_messages)) {
    $signin_user = new User();
    try {
        $dao = new UserDao();

        switch ($login) {
            case 'pseudo':
                $signin_user->setPseudo($signin_post['login'])->setPassword($signin_post['password']);
                $user = $dao->getUserByPseudo($signin_user);
                break;

            case 'email':
                $signin_user->setEmail($signin_post['login'])->setPassword($signin_post['password']);
                $user = $dao->getUserByEmail($signin_user);
                break;
        }

        if ($user->getId()) {
            if (password_verify($signin_user->getPassword(), $user->getPassword())) {
                $_SESSION['user'] = $user;
                $page = 'home';
            } else {
                $page = 'signin';
                $error_messages['log'] = 'Identifiant pas glop';
                $user = User::createNullObject();
            }
        } else {
            $page = 'signin';
            $error_messages['log'] = 'Identifiant pas glop';
        }
    } catch (PDOException $ex) {
        $page = 'signin';
        echo $ex->getMessage();
    }
} else {
    $page = 'signin';
}

include VIEW . '/index.php';
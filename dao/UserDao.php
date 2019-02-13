<?php

namespace dao;

use model\User;
use \PDO;
use \PDOException;

class UserDao
{
    private $pdo;

    public function __construct()
    {
        $conf = parse_ini_file(CONFIG_FILE_PATH, false, INI_SCANNER_TYPED);
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $this->pdo = new PDO($conf['dsn'], $conf['user'], $conf['password'], $options);
    }

    public function addUser(User $user) : User
    {
        $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $stmt = $this->pdo->prepare('INSERT INTO user(pseudo, email, password) VALUES (:pseudo, :email, :password)');
        $stmt->execute([
            ':pseudo' => $user->getPseudo(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword()
        ]);
        return $user->setId($this->pdo->lastInsertId());
    }

    public function getUserByPseudo(User $user) : User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
        $stmt->execute([
            ':pseudo' => $user->getPseudo()
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $identified_user = new User;
            return $identified_user->setId($result['id'])->setPseudo($result['pseudo'])->setEmail($result['email'])->setPassword($result['password']);
        } else {
            return User::createNullObject();
        }
    }

    public function getUserByEmail(User $user) : User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->execute([
            ':email' => $user->getEmail()
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $identified_user = new User;
            return $identified_user->setId($result['id'])->setPseudo($result['pseudo'])->setEmail($result['email'])->setPassword($result['password']);
        } else {
            return User::createNullObject();
        }
    }

    public function getUserById(User $user) : User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = :id');
        $stmt->execute([
            ':id' => $user->getId()
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $existing_user = new User;
            return $existing_user->setId($result['id'])->setPseudo($result['pseudo'])->setPassword($result['password']);
        } else {
            return User::createNullObject();
        }
    }

    public function updateUser(User $user) : void
    {
        $stmt = $this->pdo->prepare('UPDATE user SET pseudo = :pseudo WHERE id = :id');
        $stmt->execute([
            ':id' => $user->getId(),
            ':pseudo' => $user->getPseudo()
        ]);
    }
}

<?php

include 'DB.php';

class User
{
    public static function sanitizeName()
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        return $name;
    }

    public static function sanitizeEmail()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        return $email;
    }

    public static function sanitizePassword()
    {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        return $password;
    }

    public static function validateName($name)
    {
        $regex = "/[a-zA-z\s]{3,}/";
        $valid_name = preg_match($regex, $name) ? true : false;

        return $valid_name;
    }

    public static function validateEmail($email)
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $regex = "/[a-zA-Z0-9.\-_]{1,}@{1}[a-zA-Z0-9]{3,}[.]{1}[a-zA-Z0-9]{1,}.{0,}/";
        $valid_email = preg_match($regex, $email) ? true : false;

        return $valid_email;
    }

    public static function login($email)
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public static function check()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->bindValue(1, $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $is_valid_user = (!isset($user['id']) || $_SESSION['user_id'] !== $user['id']) ? false : true;

        return $is_valid_user;
    }

    public static function add($name, $email)
    {
        // Insert to DB
        $pdo = DB::connect();
        $stmt = $pdo->prepare('INSERT INTO subscribe (`name`, `email`) VALUES (?, ?)');
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $email);
        ($stmt->execute()) ?
            header('location: ../index.php?success=true') :
            header('location: ../index.php?error=true');
    }

    public static function delete($id)
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare('DELETE FROM subscribe WHERE id = ?');
        $stmt->bindValue(1, $id);
        ($stmt->execute()) ?
          header('location: ./message.php?success=true') :
          header('location: ./message.php?error=true');
    }
}

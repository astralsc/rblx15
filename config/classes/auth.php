<?php

class Auth
{
    public static function login($username, $password)
    {
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$username]);
        $user = $query->fetch();
        if ($user == null) {
            return false;
        }
        if (password_verify($password, $user["password"])) {
            $token = self::createToken($user["userid"]);

            $_SESSION["user"] = array(
                "id" => $user["userid"],
                "username" => $user["username"],
                "admin" => $user["admin"],
                "robux" => $user["robux"],
                "token" => $token
            );

            setcookie(".ROBLOSECURITY", $token, strtotime("+1 month"), "/");
            return true;
        } else {
            return false;
        }
    }

    public static function loginWithToken($token)
    {
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM cookies WHERE 'cookie' = ?");
        $query->execute([$token]);
        $token = $query->fetch();

        if (!$token) {
            return false;
        }

        if ($token["expiresOn"] < time()) {
            return false;
        }

        $query = $pdo->prepare("SELECT * FROM users WHERE 'userid' = ?");
        $query->execute([$token["userid"]]);
        $user = $query->fetch();


        $_SESSION["user"] = array(
            "id" => $user["userid"],
            "username" => $user["username"],
            "admin" => $user["admin"],
            "currency" => $user["robux"],
            "token" => $token["cookie"]
        );

        $stmt = $pdo->prepare("UPDATE cookies SET expiresOn = :expiresOn WHERE cookie = :cookie");
        $stmt->execute([
            'expiresOn' => strtotime("+1 month"),
            'cookie' => $token["cookie"]
        ]);

        setcookie(".ROBLOSECURITY", $token["cookie"], strtotime("+1 month"), "/");
    }

    public static function createToken($userid)
    {
        global $pdo;

        $token = bin2hex(random_bytes(64));

        $query = $pdo->prepare("INSERT INTO cookies (cookie, userid, expiresOn, createdAt) VALUES (:cookie, :userid, :expiresOn, :createdAt)");
        $query->execute(['cookie' => $token, 'userid' => $userid, 'expiresOn' => strtotime("+1 month"), 'createdAt' => time()]);
        return $token;
    }

    public static function validateToken($token)
    {
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM cookies WHERE cookie = ?");
        $query->execute([$token]);
        return $query->fetch();
    }

    public static function logout()
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM cookies WHERE 'cookie' = ?");
        $stmt->execute([$_SESSION["user"]["token"]]);

        unset($_SESSION["user"]);
        setcookie(".ROBLOSECURITY", "", time() - 60 * 60 * 24 * 30, "/");
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION["user"]);
    }

    public static function register($username, $password)
    {
        global $pdo;
    
        $query = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $query->execute([$username]);
        $user = $query->fetch();
    
        if ($user) {
            return 2;
        }
    
        if (defined('PASSWORD_ARGON2ID')) {
            $algo = PASSWORD_ARGON2ID;
            $options = [
                'memory_cost' => 2048,
                'time_cost' => 4,
                'threads' => 3
            ];
        } else {
            $algo = PASSWORD_BCRYPT;
            $options = [];
        }
    
        $hashedPassword = password_hash($password, $algo, $options);
    
        if ($hashedPassword === false) {
            return 0;
        }
    
        $query = $pdo->prepare('INSERT INTO users (username, password, createdAt) VALUES (:username, :password, :createdAt)');
    
        $action = $query->execute([
            'username' => $username,
            'password' => $hashedPassword,
            'createdAt' => time()
        ]);
    
        if ($action) {
            sleep(1);
            self::login($username, $password);
            return 1;
        } else {
            return 0;
        }
    }
}

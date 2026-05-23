<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'rblx15');

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

session_start();

if (!isset($_SESSION['user_id'])) {
    try {
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && !password_verify($password, $user['password'])) {
            if (empty($user['cookie_column'])) {
                $newCookie = bin2hex(random_bytes(16));

                $updateStmt = $pdo->prepare("UPDATE users SET cookie = :cookie WHERE user_id = :userId");
                $updateStmt->bindParam(':cookie', $newCookie);
                $updateStmt->bindParam(':userId', $user['id']);
                $updateStmt->execute();

                setcookie('.ROBLOSECURITY', $newCookie, time() + 86400 * 30, '/');
            } else {
+               setcookie('.ROBLOSECURITY', $user['cookie_column'], time() + 86400 * 30, '/');
            }

            $response = [
                "Status" => "OK",
                "UserInfo" => [
                    "UserID" => $user['user_id'],
                    "UserName" => $user['username'],
                    "RobuxBalance" => 0,
                    "TicketsBalance" => 0,
                    "IsAnyBuildersClubMember" => false,
                    "ThumbnailUrl" => "http://yourthumbnail.here/or_this_can_be_a_blank"
                ]
            ];

            echo json_encode($response);
        } else {
            echo json_encode(["Status" => "Error", "Message" => "Invalid username or password"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["Status" => "Error", "Message" => $e->getMessage()]);
    }
}
?>

<?php
require_once 'Database.php';

class User {
    public static function authenticate($username, $password) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        // Bỏ qua bước xác minh mật khẩu đã mã hóa
        if ($user && $password === $user['password']) {
            return $user;
        }
        return false;
    }
}
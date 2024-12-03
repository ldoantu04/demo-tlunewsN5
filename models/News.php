<?php
require_once 'Database.php';

class News {
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM news");
        return $stmt->fetchAll();
    }

    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function add($title, $content, $image, $category_id) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO news (title, content, image, category_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $content, $image, $category_id]);
    }

    public static function update($id, $title, $content, $image, $category_id) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $image, $category_id, $id]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM news WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public static function search($keyword) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM news WHERE title LIKE ? OR content LIKE ?");
        $keyword = '%' . $keyword . '%';
        $stmt->execute([$keyword, $keyword]);
        return $stmt->fetchAll();
    }
    
}

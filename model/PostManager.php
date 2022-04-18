<?php
namespace BIGBen\MyWebSite\Model;

require_once("model/Manager.php");

class PostManager extends \BIGBen\MyWebSite\Model\Manager {
    public function getPosts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%Y-%m-%d %H:%i:%s\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%Y-%m-%d %H:%i:%s\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}
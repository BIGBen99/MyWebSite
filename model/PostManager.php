<?php
namespace BIGBen\MyWebSite\Model;

require_once('model/Manager.php');

class PostManager extends \BIGBen\MyWebSite\Model\Manager {
    public function getPosts() {
        $queryResult = $this->executeQuery('SELECT id, title, content, creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $queryResult;
    }

    public function getPost($postId) {
        $queryResult = $this->executeQuery('SELECT id, title, content, creation_date FROM posts WHERE id = ?', array($postId));
        $post = $queryResult->fetch();

        return $post;
    }
}
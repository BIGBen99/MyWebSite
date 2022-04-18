<?php
namespace BIGBen\MyWebSite\Model;

require_once('model/Manager.php');

class CommentManager extends \BIGBen\MyWebSite\Model\Manager {
    public function getComments($postId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, comment_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function updateComment($commentId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET author = ?, comment = ?, comment_date = NOW() WHERE id = ' . $commentId);
        $affectedLines = $comments->execute(array($author, $comment));
    }
}
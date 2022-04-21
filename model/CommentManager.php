<?php
namespace BIGBen\MyWebSite\Model;

require_once('framework/Manager.php');

class CommentManager extends \BIGBen\MyWebSite\Framework\Manager {
    public function getComments($postId) {
        $comments = $this->executeQuery('SELECT id, author, comment, comment_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC', array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment) {
        $affectedLines = $this->executeQuery('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())', array($postId, $author, $comment));

        return $affectedLines;
    }

    public function updateComment($commentId, $author, $comment) {
        $affectedLines = $this->executeQuery('UPDATE comments SET author = ?, comment = ?, comment_date = NOW() WHERE id = ' . $commentId, array($author, $comment));
        
        return $affectedLines;
    }
}

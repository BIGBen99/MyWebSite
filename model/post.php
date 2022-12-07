<?php
// model/post.php

require_once 'lib/database.php';

class Post {
    public int $id;
    public string $title;
    public string $content;
    public string $frenchCreationDate;
}

class PostRepository {
    public DatabaseConnection $connection;

    function getPost(string $dsn, string $username, string $password, int $id): Post {
        $statement = $this->connection->getConnection($dsn, $username, $password)->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?");
        $statement->execute([$id]);
        $row = $statement->fetch();
        $post = new Post();
        $post->id = $row['id'];
        $post->title = $row['title'];
        $post->content = $row['content'];
        $post->frenchCreationDate = $row['french_creation_date'];

        return $post;
    }

    function getPosts(string $dsn, string $username, string $password): array {
        $statement = $this->connection->getConnection($dsn, $username, $password)->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5");
        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new Post();
            $post->id = $row['id'];
            $post->title = $row['title'];
            $post->content = $row['content'];
            $post->frenchCreationDate = $row['french_creation_date'];

            $posts[] = $post;
        }
        return $posts;
    }
}

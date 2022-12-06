<?php
// model/post.php

class Post {
    public int $id;
    public string $title;
    public string $content;
    public string $frenchCreationDate;
}

class PostRepository {
    public ?PDO $database = null;

    function getPost(string $dsn, string $username, string $password, int $id): Post {
        $this->dbConnect($this, $dsn, $username, $password);

        $statement = $repository->database->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?");
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
        $this->dbConnect($this, $dsn, $username, $password);

        $statement = $repository->database->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5");
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

    function dbConnect(PostRepository $repository, string $dsn, string $username, string $password) {
        if ($repository->database === null) {
            $repository->database = new PDO($dsn, $username, $password);
        }
    }
}

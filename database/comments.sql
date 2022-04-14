CREATE TABLE comments {
    id              INT PRIMARY KEY NOT NULL,
    post_id         INT,
    author          VARCHAR(100),
    comment         TEXT,
    comment_date    DATETIME,
}

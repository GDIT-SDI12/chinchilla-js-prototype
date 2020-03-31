-- Drop tables

DROP TABLE IF EXISTS saved_posts;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS post_types;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS mailer;

-- Create tables
-- Create default Spring Security tables schema

CREATE TABLE roles
(
    role varchar(20) primary key
);

CREATE TABLE users
(
    username     varchar(50) PRIMARY KEY,
    password     varchar(50)        NOT NULL,
    first_name   varchar(50),
    last_name    varchar(50),
    email        varchar(30) UNIQUE NOT NULL,
    phone_number varchar(15),
    role         varchar(20)        NOT NULL,
    FOREIGN KEY (role) references roles (role)
);

CREATE TABLE post_types
(
    id   int AUTO_INCREMENT PRIMARY KEY,
    type varchar(20)
);

CREATE TABLE posts
(
    id          int AUTO_INCREMENT PRIMARY KEY,
    author      varchar(50) NOT NULL,
    body        TEXT        NOT NULL,
    title       varchar(50) NOT NULL,
    created_at  TIMESTAMP            DEFAULT CURRENT_TIMESTAMP,
    expiry_date TIMESTAMP            DEFAULT (CURRENT_TIMESTAMP + interval 30 day),
    approved_at TIMESTAMP,
    is_active   BOOLEAN     NOT NULL DEFAULT true,
    type        int         NOT NULL,
    CONSTRAINT posts_FK_users FOREIGN KEY (author) REFERENCES users (username) ON UPDATE CASCADE,
    FOREIGN KEY (type) REFERENCES post_types (id)
);


CREATE TABLE images
(
    post_id  int          NOT NULL,
    filename varchar(100) NOT NULL,
    KEY images_FK_posts (post_id),
    CONSTRAINT PRIMARY KEY (post_id, filename),
    CONSTRAINT images_FK_posts FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE saved_posts
(
    username varchar(50) NOT NULL REFERENCES users (username),
    post_id  int         NOT NULL REFERENCES posts (id),
    PRIMARY KEY (username, post_id)
);

CREATE TABLE mailer
(
    host     varchar(30)  NOT NULL DEFAULT 'smtp.example.com',
    username varchar(100) NOT NULL DEFAULT 'example@email.com',
    password varchar(100) NOT NULL DEFAULT 'examplepass',
    port     int          NOT NULL DEFAULT 587,
    maskname varchar(100) NOT NULL DEFAULT 'Mailer'
)

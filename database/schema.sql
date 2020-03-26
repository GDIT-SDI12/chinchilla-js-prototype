-- Drop tables

DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS post_types;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS roles;

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
    role         varchar(20)                NOT NULL,
    FOREIGN KEY (role) references roles (role)
);

CREATE TABLE post_types(
    id  int AUTO_INCREMENT PRIMARY KEY,
    type varchar(20)
);

CREATE TABLE posts
(
    id          int AUTO_INCREMENT PRIMARY KEY,
    author      varchar(50) NOT NULL,
    body        TEXT        NOT NULL,
    title       varchar(50) NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expiry_date TIMESTAMP DEFAULT (CURRENT_TIMESTAMP + interval 30 day),
    approved_at TIMESTAMP,
    is_active BOOLEAN NOT NULL DEFAULT true,
    type int NOT NULL,
    CONSTRAINT `posts_FK_users` FOREIGN KEY (`author`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
    FOREIGN KEY (type) REFERENCES post_types(id)
);


CREATE TABLE images (
  `post_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  KEY `images_FK_posts` (`post_id`),
  CONSTRAINT `images_FK_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

ALTER TABLE images ADD CONSTRAINT images_UN UNIQUE KEY (post_id,filename);
CREATE DATABASE  IF NOT EXISTS laravel_red_social;

USE laravel_red_social ;

CREATE TABLE IF NOT EXISTS users(
    id_user         INT(255) auto_increment not null,
    role            VARCHAR(255),
    name            VARCHAR(100),
    surname         VARCHAR(255),
    nick            VARCHAR(100),
    email           VARCHAR(255),    
    password        VARCHAR(255),
    image           VARCHAR(255),
    created_at      DATETIME, 
    updated_at      DATETIME,
    remember_token  VARCHAR(255),
    CONSTRAINT pk_users PRIMARY KEY(id_user)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS images(
    id_image             INT(255) auto_increment not null,
    fk_id_user           INT(255),
    image_path           VARCHAR(100),
    description          TEXT,
    created_at           DATETIME, 
    updated_at           DATETIME,
    CONSTRAINT pk_images PRIMARY KEY(id_image),
    CONSTRAINT fk_images_users FOREIGN KEY(fk_id_user) REFERENCES users(id_user) 
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS comments(
    id_comment      INT(255) auto_increment not null,
    fk_id_user      INT(255),
    fk_id_image     INT(255),
    content         TEXT,
    created_at      DATETIME, 
    updated_at      DATETIME,
    CONSTRAINT pk_comments PRIMARY KEY(id_comment),
    CONSTRAINT fk_comments_users FOREIGN KEY(fk_id_user) REFERENCES users(id_user),
    CONSTRAINT fk_comments_images FOREIGN KEY(fk_id_image) REFERENCES images(id_image) 
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS likes(
    id_like         INT(255) auto_increment not null,
    fk_id_user      INT(255),
    fk_id_image     INT(255),
    CONSTRAINT pk_likes PRIMARY KEY(id_like),
    CONSTRAINT fk_likes_users FOREIGN KEY(fk_id_user) REFERENCES users(id_user),
    CONSTRAINT fk_likes_images FOREIGN KEY(fk_id_image) REFERENCES images(id_image)
)ENGINE=InnoDB;



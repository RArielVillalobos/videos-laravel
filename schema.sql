CREATE DATABASE IF NOT EXISTS videos-laravel;
USE videos-laravel;

CREATE TABLE users(
  id INT (255) AUTO_INCREMENT not null,
  role VARCHAR (20),
  name VARCHAR(255),
  surname VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  image VARCHAR(255),
  created_at DATETIME,
  updated_at DATETIME,
  remember_token VARCHAR(255),

  CONSTRAINT pk_users PRIMARY KEY (id)


)ENGINE=InnoDb;

CREATE TABLE videos(
  id INT(255)  AUTO_INCREMENT NOT NULL,
  user_id INT(255) NOT NULL ,
  title VARCHAR(255),
  description TEXT,
  status VARCHAR(20),
  image VARCHAR(255),
  video_path VARCHAR(255),
  created_at DATETIME,
  updated_at DATETIME,

  CONSTRAINT pk_videos PRIMARY KEY (id),
  CONSTRAINT  fk_video_users FOREIGN KEY (user_id) REFERENCES users(id)


)ENGINE =InnoDb;

CREATE TABLE comments(
  id INT(255), AUTO_INCREMENT NOT NULL ,
  user_id int(255) NOT NULL ,
  video_id INT(255) NOT NULL ,
  body TEXT,
  created_at DATETIME,
  updated DATETIME,

  CONSTRAINT pk_comments PRIMARY KEY (id),
  CONSTRAINT   comments_users FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT comments_videos FOREIGN KEY (video_id) REFERENCES videos(id)


)ENGINE=InnoDb;
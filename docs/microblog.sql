CREATE DATABASE `microblog`;

USE `microblog`;

CREATE TABLE `users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(64) NOT NULL,
  `user_username` VARCHAR(32) NOT NULL,
  `user_email` VARCHAR(128) NOT NULL,
  `user_password` VARCHAR(256) NOT NULL,
  `user_profile_picture` VARCHAR(256) DEFAULT 'default.png',
  `user_created` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id)
)ENGINE=INNODB;

CREATE TABLE `posts` (
  `post_id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_content` VARCHAR(500) NOT NULL,
  `post_by` INT(11) NOT NULL,
  `post_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (post_id)
)ENGINE=INNODB;

CREATE TABLE `replies` (
  `reply_id` INT(11) NOT NULL AUTO_INCREMENT,
  `reply_content` VARCHAR(500) NOT NULL,
  `reply_by` INT(11) NOT NULL,
  `reply_post` INT(11) NOT NULL,
  `reply_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (reply_id)
)ENGINE=INNODB;

CREATE TABLE `follows` (
  `follow_id` INT(11) NOT NULL AUTO_INCREMENT,
  `follow_user` INT(11) NOT NULL,
  `follow_follow` INT(11) NOT NULL,
  PRIMARY KEY (follow_id)
)ENGINE=INNODB;
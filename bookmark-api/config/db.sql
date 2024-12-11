CREATE DATABASE bookmark_db;
USE bookmark_db;
CREATE TABLE bookmarks(
    id MEDIUMINT NOT NULL AUTO_INCREMENT,
    Link VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    dateAdded DateTime NOT NULL,
    PRIMARY KEY (id)
    );

INSERT INTO bookmarks(link, title, dateAdded) VALUES ('https://www.youtube.com/','Youtube', NOW());
INSERT INTO bookmarks(link, title, dateAdded) VALUES ('https://suhaibag.github.io/FCIT-registration/','FCIT Course Picker', NOW());
INSERT INTO bookmarks(link, title, dateAdded) VALUES ('https://github.com/','Github', NOW());
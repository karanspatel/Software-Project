DROP TABLE posts;

// CALL THE DATABASE ghostpost, use this capitalization method. 

USE ghostpost;

CREATE TABLE posts (
    PostID int,
    UserID varchar(100),
    UniversityName varchar(100),
    Content varchar(500),
    Upvotes int,
    Downvotes int,
    TimeAndDate DATETIME,
    PRIMARY KEY (PostID)
);

CREATE TABLE users (
    UserID varchar(100),
    Email varchar(100),
    Pswd varchar(100),
    PRIMARY KEY (UserID)
);

INSERT INTO users VALUES (
    '39asdfl23bn4',
    'clrhoades1@gmail.com',
    'connor'
);

# For insert validation 

SELECT *
FROM posts
WHERE PostID = 554345432;

SELECT *
FROM posts
WHERE UniversityName = 'East Carolina University';

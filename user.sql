DROP TABLE IF EXISTS user;
CREATE TABLE user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO user (pseudo, email, password) VALUES ('Foo', 'foo@bar.com', '$2y$10$a447gBNKT8KpxOIW14E2/ONATp38kiWxQgScNx5dRKS56xDVHJjfm');
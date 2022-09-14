CREATE TABLE saee_giver.customers (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(30),
    last_name varchar(30),
    email varchar(50),
    gender varchar(10),
    ip_address varchar(15),
    company varchar(30),
    city varchar(30),
    title varchar(50),
    website TEXT
);
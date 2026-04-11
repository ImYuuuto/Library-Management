-- Active: 1775722727837@@127.0.0.1@3306@gestion_biblio
create database gestion_biblio;

use gestion_biblio;


create table users(
    id int PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin','teacher') DEFAULT 'teacher'
);

create table categories(
    id int AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(100)
);
create table books(
    id int AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(255),
    category_id int ,
    description text,
    image VARCHAR(255),
    available int DEFAULT 1,
    Foreign Key (category_id) REFERENCES categories(id)
);

create table borrowing(
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int,
    book_id int,
    status enum("pending", "approved", "rejected", "returned") DEFAULT "pending",
    borrow_date date,
    return_date date,

    Foreign Key (user_id) REFERENCES users(id),
    Foreign Key (book_id) REFERENCES books(id)
);

alter table users
modify role enum("admin", "guest");

select * from users;

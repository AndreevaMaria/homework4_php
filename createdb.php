<?php
error_reporting(E_ALL);
include_once("functions.php");

$link = connect();

$ct1 = 'CREATE TABLE sectors(
    id int not null auto_increment primary key,
    sector varchar(64) unique
)default charset="utf8"';

$ct2 = 'CREATE TABLE categories(
    id int not null auto_increment primary key,
    category varchar(64) unique,
    sectorid int,
    foreign key(sectorid) references sectors(id) on delete cascade
)default charset="utf8"';

$ct3 = 'CREATE TABLE products(
    id int not null auto_increment primary key,
    product varchar(20),
    price int,
    categoryid int,
    foreign key(categoryid) references categories(id) on delete cascade,
    sectorid int,
    foreign key(sectorid) references sectors(id) on delete cascade,
    make varchar(20),
    model varchar(20),
    country varchar(20),
    info varchar(1024)
)default charset="utf8"';

$ct4 = 'CREATE TABLE users(
    id int not null auto_increment primary key,
    login varchar(64) unique,
    pass varchar(128),
    email varchar(128)
)default charset="utf8"';

mysqli_query($link, $ct1);
if(mysqli_errno($link)) {
    echo "Error code 1 " . mysqli_errno($link) . "<br>";
    exit;
}
mysqli_query($link, $ct2);
if(mysqli_errno($link)) {
    echo "Error code 2 " . mysqli_errno($link) . "<br>";
    exit;
}
mysqli_query($link, $ct3);
if(mysqli_errno($link)) {
    echo "Error code 3 " . mysqli_errno($link) . "<br>";
    exit;
}
mysqli_query($link, $ct4);
if(mysqli_errno($link)) {
    echo "Error code 4 " . mysqli_errno($link) . "<br>";
    exit;
}
?>
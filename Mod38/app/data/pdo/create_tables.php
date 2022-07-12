<?php
$table = "tcompany";
try {
    $db = new PDO("mysql:dbname=mydb;host=localhost", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Error Handling
    $sql ="CREATE table $table(
     ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
     Prename VARCHAR( 50 ) NOT NULL, 
     Name VARCHAR( 250 ) NOT NULL,
     StreetA VARCHAR( 150 ) NOT NULL, 
     StreetB VARCHAR( 150 ) NOT NULL, 
     StreetC VARCHAR( 150 ) NOT NULL, 
     County VARCHAR( 100 ) NOT NULL,
     Postcode VARCHAR( 50 ) NOT NULL,
     Country VARCHAR( 50 ) NOT NULL);" ;
    $db->exec($sql);
    print("Created $table Table.\n");
} catch (PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}




// SQL statement for creating new tables
$statements = [
    'CREATE TABLE authors( 
        author_id   INT AUTO_INCREMENT,
        first_name  VARCHAR(100) NOT NULL, 
        middle_name VARCHAR(50) NULL, 
        last_name   VARCHAR(100) NULL,
        PRIMARY KEY(author_id)
    );',
    'CREATE TABLE book_authors (
        book_id   INT NOT NULL, 
        author_id INT NOT NULL, 
        PRIMARY KEY(book_id, author_id), 
        CONSTRAINT fk_book 
            FOREIGN KEY(book_id) 
            REFERENCES books(book_id) 
            ON DELETE CASCADE, 
            CONSTRAINT fk_author 
                FOREIGN KEY(author_id) 
                REFERENCES authors(author_id) 
                ON DELETE CASCADE
    )'];

// connect to the database
$pdo = require 'connect.php';

// execute SQL statements
foreach ($statements as $statement) {
    $pdo->exec($statement);
}

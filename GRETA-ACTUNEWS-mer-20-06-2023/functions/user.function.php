<?php

function  insertUser(string $firstname, string $lastname, string $email, string $password): bool|string

{
    global $dbh;
   $sql = 'INSERT INTO user (firstname, lastname, email, password, createdAt, updatedAt)
VALUES (:firstname, :lastname, :email, :password, :createdAt, :updatedAt)';
   $query= $dbh->prepare($sql);
   $query->bindValue('firstname' ,$firstname, PDO::PARAM_STR);
   $query->bindValue('lastname',$lastname, PDO::PARAM_STR);
   $query->bindValue('email',$email, PDO::PARAM_STR);
   $query->bindValue('password',$password, PDO::PARAM_STR);
   $query->bindValue('createdAt', (new DateTime())->format('Y-m-d H:i:s'));
   $query->bindValue('updatedAt', (new DateTime())->format('Y-m-d H:i:s'));

    return $query->execute() ? $dbh->lastInsertId() : false;

}


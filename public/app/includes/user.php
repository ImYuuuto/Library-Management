<?php
    function createUser($conn, $name, $email, $password){
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "insert into users (name,email,password)
        values(?,?,?);";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$name, $email, $hashed]);
    }

    function findUserByEmail($conn, $email){

        $sql = "select * from users where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
?>
<?php
class User {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $email, $password){
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "insert into users (name, email, password) values(?,?,?);"
        );

        $stmt->execute([$name, $email, $hashed]);
    }

    public function findByEmail($email){
        $stmt = $this->conn->prepare(
            "select * from users where email = ? ;"
        );

        $stmt->execute([$email]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
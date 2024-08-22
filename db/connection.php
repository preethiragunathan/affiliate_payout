<?php
include("connect.php");

class database extends connect
{
    var $con;

    public function __construct()
    {
        date_default_timezone_set("Asia/Dubai");
        session_start();
        $dsn = "mysql:host={$this->host};dbname={$this->db}";
        try {
            $this->con = new PDO($dsn, $this->user, $this->pswd);
        } catch (PDOException $e) {
            throw new Exception("Connection error: " . $e->getMessage());
        }
    }

    // function insert_data($data)
    // {
    //     $stmt = $this->con->prepare("INSERT INTO user (firstname,email,mobile,password) VALUES (?,?,?,?)");
    //     return $stmt->execute($data);
    // }

    public function insert_data($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute(array_values($data));
    }
}

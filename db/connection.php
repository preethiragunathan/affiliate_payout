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

    public function insert_data($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute(array_values($data))) {
            return $this->con->lastInsertId();
        } else {
            return false;
        }
    }

    public function select_column_by_id($column, $table, $id)
    {
        $stmt = $this->con->prepare("SELECT $column FROM $table WHERE id=?");
        $data = array($id);
        $stmt->execute($data);
        return $stmt->fetchColumn();
    }

    public function login($data)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute($data);
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else
            return 0;
    }

    public function select_all_by_column($table, $column, $val)
    {
        $stmt = $this->con->prepare("SELECT * FROM $table WHERE $column=?");
        $data = array($val);
        $stmt->execute($data);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_data($table, $data, $where)
    {
        $set = "";
        foreach ($data as $column => $value) {
            $set .= "$column = ?, ";
        }
        $set = rtrim($set, ", ");
        $whereClause = "";
        foreach ($where as $column => $value) {
            $whereClause .= "$column = ? AND ";
        }
        $whereClause = rtrim($whereClause, " AND ");

        $sql = "UPDATE $table SET $set WHERE $whereClause";
        $stmt = $this->con->prepare($sql);

        $values = array_merge(array_values($data), array_values($where));
        return $stmt->execute($values);
    }

    public function get_user_heirarchy($data)
    {
        $sql = "WITH RECURSIVE hierarchy AS ( SELECT id, referrer_id, level FROM users WHERE id = ?
                UNION ALL
                SELECT u.id, u.referrer_id, u.level
                FROM users u
                INNER JOIN hierarchy h ON u.id = h.referrer_id
                WHERE h.level > 1 )
            SELECT * FROM hierarchy
            WHERE level <= 5;";  
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$data['id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_total_commission($user_id) {
        $sql = "SELECT SUM(amount) as total_commission FROM payouts WHERE user_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_commission'];
    }
}

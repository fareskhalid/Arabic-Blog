<?php
/**
 * mysql database connection class
 */

class DB
{
    private string $user = 'padmin';
    private string $pass = '123456';
    private string $db_name = 'tadwinat';
    private string $host = 'localhost';

    public ?PDO $con;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db_name";
            $this->con =  new PDO($dsn, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Database Connection Failed: ' . $e->getMessage());
        }
    }
    public function __destruct()
    {
        $this->con = null;
    }

    public function get(
        string $table_name,
        string $where = null,
        ?string $orderBy = null,
        ?string $type = 'ASC',
        int $limit = null): array | bool
    {
        $orderBy = $orderBy ? "ORDER BY $orderBy $type" : '';
        $limit = $limit ? " LIMIT $limit" : '';
        $where = $where ? "WHERE $where" : '';
        $select_query = $this->con->query("SELECT * FROM $table_name $where " . $orderBy . $limit);
        return $select_query->fetchAll();
    }

    public function getOne(string $table_name, string $where = null)
    {
        $where = $where ? "WHERE $where" : '';
        $select_one = $this->con->prepare("SELECT * FROM $table_name ? LIMIT 1");
        $select_one->execute([$where]);
        return $select_one->fetch();
    }

    public function insert(string $table_name, array | string $columns, array | string $values): bool
    {
        $columns = is_array($columns) ? implode(',', $columns) : $columns;
        $values = is_array($values) ? "'" . implode('\',\'', $values) . "'" : $values;
        return (bool) $this->con->query("INSERT INTO $table_name ($columns) VALUES ($values)");
    }

    public function delete(string $table, int $id): bool
    {
        return (bool) $this->con->query("DELETE FROM $table WHERE id = $id");
    }

    public function isAdmin(string $email, string $password): bool
    {
        $check = $this->con->prepare('SELECT * FROM admins WHERE email = ? AND password = ?');
        $check->execute([$email, $password]);
        return (bool) $check->fetch();
    }
}
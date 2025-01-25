<?php

require_once __DIR__ . '/config.php';

class Database
{
    private $conn;

    public function __construct() //crea la connessione
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
            die("Connessione fallita: " . $this->conn->connect_error);
            echo("Errore di connessione");
        }

    }


    public function getAllAnimaliMarini(): array //return array
    {
        $sql = "SELECT * FROM AnimaliMarini";
        $result = $this->conn->query($sql);

        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function searchAnimaliByName(string $nome): array
    {
        // Protegge da injection
        $nome = $this->conn->real_escape_string($nome);
    
        $sql = "SELECT * FROM AnimaliMarini
                WHERE Nome LIKE '%$nome%'";
    
        $result = $this->conn->query($sql);
    
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function close()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

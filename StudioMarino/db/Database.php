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

    public function getUser(string $email, string $password): int //metodo per controllare l'utente
    {
        // Protegge da injection
        $email = $this->conn->real_escape_string($email);

        $sql = "SELECT * FROM utente
                WHERE email LIKE '%$email%'";
    
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) 
        {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['pass'])) 
            {
                return 0; //login corretto
            } 
            else 
            {
                return -2; //password errata
            }
        }
        else
        {
            return -1; //utente inesistente
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

    public function addAnimali(string $nome, float $lat, float $long, string $specie, string $desc, string $data)
    {
        $sql = "";

        if (isset($desc) && !empty($desc))
        {
            if (isset($data) && !empty($data))
            {
                $sql = "INSERT INTO AnimaliMarini (Nome, Latitudine, Longitudine, Specie, Descrizione, DataAvvistamento) VALUES ($nome, $lat, $long, $specie, $desc, $data)";
            }
            else
            {
                $sql = "INSERT INTO AnimaliMarini (Nome, Latitudine, Longitudine, Specie, Descrizione) VALUES ($nome, $lat, $long, $specie, $desc)";
            }
        }
        else
        {
            if (isset($data) && !empty($data))
            {
                $sql = "INSERT INTO AnimaliMarini (Nome, Latitudine, Longitudine, Specie, DataAvvistamento) VALUES ($nome, $lat, $long, $specie, $data)";
            }
            else
            {
                $sql = "INSERT INTO AnimaliMarini (Nome, Latitudine, Longitudine, Specie) VALUES ($nome, $lat, $long, $specie)";
            }
        }

        $this->conn->query($sql);
    }

    public function close()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
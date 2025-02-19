<?php
    require_once __DIR__ . '/../config/db.php';

    class Database
    {
        private $conn;

        public function __construct() 
        {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($this->conn->connect_error) 
            {
                die("Connessione fallita: " . $this->conn->connect_error);
                echo("Errore di connessione");
            }

        }

        public function getUser(string $email, string $password): int 
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

        
        public function close()
        {
            if ($this->conn) 
            {
                $this->conn->close();
            }
        }
    }
?>

    // public function getAllAnimaliMarini(): array //return array
    // {
    //     $sql = "SELECT * FROM AnimaliMarini";
    //     $result = $this->conn->query($sql);

    //     $data = [];
    //     if ($result && $result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //     }
    //     return $data;
    // }

    // public function getAllSpecie(): array //return array
    // {
    //     $sql = "SELECT DISTINCT Specie FROM AnimaliMarini";
    //     $result = $this->conn->query($sql);

    //     $data = [];
    //     if ($result && $result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //     }
    //     return $data;
    // }

    // public function searchAnimaliByName(string $nome): array
    // {
    //     // Protegge da injection
    //     $nome = $this->conn->real_escape_string($nome);
    
    //     $sql = "SELECT * FROM AnimaliMarini
    //             WHERE Nome LIKE '%$nome%'";
    
    //     $result = $this->conn->query($sql);
    
    //     $data = [];
    //     if ($result && $result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //     }
    //     return $data;
    // }

    // public function addAnimali(string $nome, float $lat, float $long, string $specie, string $desc, string $data)
    // {
    //     $sql = "";

    //     if (isset($desc) && !empty($desc))
    //     {
    //         if (isset($data) && !empty($data))
    //         {
    //             $sql = "INSERT INTO AnimaliMarini (Nome, Latitudine, Longitudine, Specie, Descrizione, DataAvvistamento) VALUES ('" . $nome . "', " . $lat . ", " . $long . ", '" . $specie . "', '" . $desc . "', '" . $data . "')";
    //         }
    //         else
    //         {
    //             $sql = "INSERT INTO AnimaliMarini (Nome, Latitudine, Longitudine, Specie, Descrizione) VALUES ('" . $nome . "', " . $lat . ", " . $long . ", '" . $specie . "', '" . $desc . "')";
    //         }
    //     }
    //     else
    //     {
    //         if (isset($data) && !empty($data))
    //         {
    //             $sql = "INSERT INTO AnimaliMarini (Nome, Latitudine, Longitudine, Specie, DataAvvistamento) VALUES ('" . $nome . "', " . $lat . ", " . $long . ", '" . $specie . "', '" . $data . "')";
    //         }
    //         else
    //         {
    //             $sql = "INSERT INTO AnimaliMarini (Nome, Latitudine, Longitudine, Specie) VALUES ('" . $nome . "', " . $lat . ", " . $long . ", '" . $specie . "')";
    //         }
    //     }

    //     $this->conn->query($sql);
    // }

    // public function updateAnimali(string $nome, float $lat, float $long, string $desc, string $data) : int
    // {
    //     $result = $this->searchAnimaliByName($nome);
    //     if (isset($result) && !empty($result))
    //     {
    //         $id = $result[0]['id'];

    //         $sql = "UPDATE AnimaliMarini SET Latitudine = " . $lat . ", Longitudine = " . $long;
    //         if (isset($desc) && !empty($desc))
    //         {
    //             $sql .= ", Descrizione = '" . $desc . "'";
    //         }
    //         if (isset($data) && !empty($data))
    //         {
    //             $sql .= ", DataAvvistamento = '" . $data . "'";
    //         }
    //         $sql .= " WHERE id = " . $id;

    //         $this->conn->query($sql);

    //         return 1;
    //     }
    //     else
    //     {
    //         return 0;
    //     }
    // }
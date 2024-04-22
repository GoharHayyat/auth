 <?php
 include_once 'DB_connection.php';

 class User extends DataBase
 {
    private $table_name = 'users';
    public $id;
    public $name;
    public $email;
    public $password;

    public function register()
    {
        $queryCheck = "SELECT COUNT(*) FROM ".$this->table_name." WHERE email = :email";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(':email', $this->email);
        $stmtCheck->execute();
        $emailExists = $stmtCheck->fetchColumn();

        if ($emailExists) {
            return -99;
        }
        $query= "INSERT INTO ".$this->table_name."(name,email,password) VALUES (:name,:email,:password)";
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function login()
    {
        $query= "SELECT * FROM ".$this->table_name." WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($this->password, $row['password']))
        {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            return true;
        }
        else {
            return false;
        }
    }

    
}
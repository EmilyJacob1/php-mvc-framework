<?php
require_once '../app/core/config.php';

class AccountModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllAccounts()
    {
        $query = "SELECT * FROM accounts WHERE archived = 0";
        $result = $this->conn->query($query);

        if ($result) {
            $accounts = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $accounts = false;
        }
        return $accounts;
    }

    public function getAccountByEmail($email)
    {
        $query = "SELECT * FROM accounts WHERE accountEmail = ? AND archived = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $account = $result->fetch_assoc();
    
        return $account;
    }

    public function getAccountById($id)
    {
        $query = "SELECT * FROM accounts WHERE accountId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $account = $result->fetch_assoc();

        return $account;
    }

    public function deleteAccount($accountId)
    {
        $query = "UPDATE accounts SET archived = 1 WHERE accountId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $accountId);
        $success = $stmt->execute();
    
        return $success;
    }

    public function addAccount($accountRole, $username, $accountEmail, $hashedPassword)
    {
        $query = "INSERT INTO accounts (accountRole, username, accountEmail, accountPassword) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $accountRole, $username, $accountEmail, $hashedPassword);
        $success = $stmt->execute();
    
        return $success;
    }
    
    public function editAccount($id, $accountRole, $username, $accountEmail, $hashedPassword)
    {
        $query = "UPDATE accounts SET accountRole = ?, username = ?, accountEmail = ?, accountPassword = ? WHERE accountId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $accountRole, $username, $accountEmail, $hashedPassword, $id);
        $success = $stmt->execute();
    
        return $success;
    }
}

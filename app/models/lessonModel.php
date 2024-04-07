<?php
require_once '../app/core/config.php';

class LessonModel
{
    private $conn;

    public function __construct()
    {
        //create new datanbase instance and connect.
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllLessons($accountId)
    {
        // Prepare the SQL query using a JOIN statement
        $query = "SELECT l.*, lr.leerlingNaam 
                  FROM lessen l 
                  INNER JOIN leerling lr ON l.leerlingId = lr.leerlingId 
                  WHERE lr.accountId = $accountId";
    
        // Execute the query
        $result = $this->conn->query($query);
    
        // Check if the query executed successfully
        if ($result) {
            // Fetch all the lessons as an associative array
            $lessons = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Set lessons to false if query execution fails
            $lessons = false;
        }
    
        // Return the lessons
        return $lessons;
    }
    
    public function getInstructeurs()
    {
        $query = "SELECT * FROM instructeur";
        $result = $this->conn->query($query);

        if ($result) {
            $lessons = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $lessons = false;
        }
        return $lessons;
    }

    public function addLesson($lessonDate, $startTime, $endTime, $instructeurId, $accountId)
    {
        // Prepare the SQL query
        $query = "INSERT INTO lessen (datum, beginTijd, eindTijd, instructeurId, leerlingId) VALUES (?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bind_param("sssss", $lessonDate, $startTime, $endTime, $instructeurId, $accountId);
    
        // Execute the query
        $success = $stmt->execute();
    
        // Return the result of the execution
        return $success;
    }
    


}

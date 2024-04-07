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
    
    public function isInstructeurAvailable($lessonDate, $startTime, $endTime, $instructeurId)
    {
        // Prepare SQL query to check for overlapping lessons
        $query = "SELECT COUNT(*) AS numLessons
                  FROM lessen
                  WHERE instructeurId = ? 
                  AND datum = ? 
                  AND ((beginTijd < ? AND eindTijd > ?)
                      OR (beginTijd < ? AND eindTijd > ?)
                      OR (beginTijd >= ? AND eindTijd <= ?))";
    
        // Prepare and bind parameters to the query
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssssss", $instructeurId, $lessonDate, $endTime, $startTime, $endTime, $startTime, $startTime, $endTime);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Fetch the count of overlapping lessons
        $count = $result->fetch_assoc()['numLessons'];
        
        // If count is 0, instructor is available
        return $count == 0;
    }


}

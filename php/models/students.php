<?php
class Student
{
    private $conn;
    private $table_name = "students";

    public $student_id;
    public $name;
    public $email;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Insert a new student
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Retrieve all students
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    // Retrieve student by ID
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE student_id = :student_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':student_id', $this->student_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->name = $row['name'];
            $this->email = $row['email'];
            return true;
        }

        return false;
    }

    // Update a student
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email WHERE student_id = :student_id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':student_id', $this->student_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a student
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE student_id = :student_id";
        $stmt = $this->conn->prepare($query);    // Sanitize input
        $this->student_id = htmlspecialchars(strip_tags($this->student_id));

        // Bind value
        $stmt->bindParam(':student_id', $this->student_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

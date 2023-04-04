<?php
// Academic Advisor class
class AcademicAdvisor
{
    private $conn;
    private $table_name = "academic_advisors";

    public $advisor_id;
    public $name;
    public $email;
    public $intro_leaflet;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (name, email, intro_leaflet) VALUES (:name, :email, :intro_leaflet)";
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->intro_leaflet = htmlspecialchars(strip_tags($this->intro_leaflet));

        // Bind values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':intro_leaflet', $this->intro_leaflet);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    // Retrieve academic advisor by ID
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE advisor_id = :advisor_id LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':advisor_id', $this->advisor_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->intro_leaflet = $row['intro_leaflet'];
            return true;
        }

        return false;
    }

    // Update an academic advisor
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, intro_leaflet = :intro_leaflet WHERE advisor_id = :advisor_id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->intro_leaflet = htmlspecialchars(strip_tags($this->intro_leaflet));
        // Bind values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':intro_leaflet', $this->intro_leaflet);
        $stmt->bindParam(':advisor_id', $this->advisor_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete an academic advisor
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE advisor_id = :advisor_id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->advisor_id = htmlspecialchars(strip_tags($this->advisor_id));

        // Bind value
        $stmt->bindParam(':advisor_id', $this->advisor_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

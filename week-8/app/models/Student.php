<?php

class Student
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Retrieve all students
     */
    public function all()
    {
        $query = "SELECT * FROM students ORDER BY id DESC";
        $result = mysqli_query($this->conn, $query);
        
        $students = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $students[] = $row;
            }
        }
        
        return $students;
    }

    /**
     * Find a single student by ID
     */
    public function find($id)
    {
        $query = "SELECT * FROM students WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        return mysqli_fetch_assoc($result);
    }

    /**
     * Create a new student
     */
    public function create($name, $email, $course)
    {
        $query = "INSERT INTO students (name, email, course) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $course);
        
        return mysqli_stmt_execute($stmt);
    }

    /**
     * Update an existing student
     */
    public function update($id, $name, $email, $course)
    {
        $query = "UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssi', $name, $email, $course, $id);
        
        return mysqli_stmt_execute($stmt);
    }

    /**
     * Delete a student
     */
    public function delete($id)
    {
        $query = "DELETE FROM students WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        
        return mysqli_stmt_execute($stmt);
    }
}


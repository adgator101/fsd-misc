<?php

class StudentController
{
    private $student;
    private $blade;

    public function __construct($student, $blade)
    {
        $this->student = $student;
        $this->blade = $blade;
    }

    /**
     * Display all students
     */
    public function index()
    {
        $students = $this->student->all();
        echo $this->blade->make('students.index', ['students' => $students])->render();
    }

    /**
     * Show the form for adding a new student
     */
    public function create()
    {
        echo $this->blade->make('students.create')->render();
    }

    /**
     * Process the form submission for adding a student
     */
    public function store()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $course = $_POST['course'] ?? '';

        if ($this->student->create($name, $email, $course)) {
            header('Location: index.php?page=students');
            exit;
        } else {
            echo "Error creating student";
        }
    }

    /**
     * Show the form for editing an existing student
     */
    public function edit($id)
    {
        $student = $this->student->find($id);
        if ($student) {
            echo $this->blade->make('students.edit', ['student' => $student])->render();
        } else {
            echo "Student not found";
        }
    }

    /**
     * Process the form submission for updating a student
     */
    public function update($id)
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $course = $_POST['course'] ?? '';

        if ($this->student->update($id, $name, $email, $course)) {
            header('Location: index.php?page=students');
            exit;
        } else {
            echo "Error updating student";
        }
    }

    /**
     * Remove a student record
     */
    public function delete($id)
    {
        if ($this->student->delete($id)) {
            header('Location: index.php?page=students');
            exit;
        } else {
            echo "Error deleting student";
        }
    }
}

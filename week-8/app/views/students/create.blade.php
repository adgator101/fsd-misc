@extends('layouts.master')

@section('content')
<div class="top-bar">
    <h2>Add New Student</h2>
    <a href="index.php?page=students" class="btn btn-secondary">← Back to List</a>
</div>

<form action="index.php?page=students&action=store" method="POST">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required placeholder="Enter student name">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Enter student email">
    </div>

    <div class="form-group">
        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required placeholder="Enter course name">
    </div>

    <div class="actions">
        <button type="submit" class="btn btn-success">Create Student</button>
        <a href="index.php?page=students" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection

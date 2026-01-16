@extends('layouts.master')

@section('content')
<div class="top-bar">
    <h2>Edit Student</h2>
    <a href="index.php?page=students" class="btn btn-secondary">← Back to List</a>
</div>

@if($student)
<form action="index.php?page=students&action=update&id={{ $student['id'] }}" method="POST">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $student['name'] }}" required placeholder="Enter student name">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $student['email'] }}" required placeholder="Enter student email">
    </div>

    <div class="form-group">
        <label for="course">Course:</label>
        <input type="text" id="course" name="course" value="{{ $student['course'] }}" required placeholder="Enter course name">
    </div>

    <div class="actions">
        <button type="submit" class="btn btn-success">Update Student</button>
        <a href="index.php?page=students" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@else
<div class="alert alert-error">
    Student not found.
</div>
@endif
@endsection

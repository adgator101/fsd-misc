@extends('layouts.master')

@section('content')
<div class="top-bar">
    <h2>Student List</h2>
    <a href="index.php?page=students&action=create" class="btn btn-primary">+ Add New Student</a>
</div>

@if(count($students) > 0)
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student['id'] }}</td>
            <td>{{ $student['name'] }}</td>
            <td>{{ $student['email'] }}</td>
            <td>{{ $student['course'] }}</td>
            <td>
                <div class="action-buttons">
                    <a href="index.php?page=students&action=edit&id={{ $student['id'] }}" class="btn btn-warning">Edit</a>
                    <a href="index.php?page=students&action=delete&id={{ $student['id'] }}" 
                       class="btn btn-danger" 
                       onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="no-records">
    <p>No students found. <a href="index.php?page=students&action=create">Add your first student</a></p>
</div>
@endif
@endsection

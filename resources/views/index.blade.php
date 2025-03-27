
@extends('layout')
@section('title', 'Students')
@section('content')
<h2>Students</h2>
<!-- TODO: Add search bar here -->
<input type="text" id="search" class="form-control" placeholder="Search by name">
<input type="number" id="minAge" class="form-control" placeholder="Min Age" >
<input type="number" id="maxAge" class="form-control mt-2" placeholder="Max Age" >

<table class="table mt-3">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
<tbody id="studentTable">
     @foreach($students as $student)
            <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->age }}</td>

            <td><a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View</a> </td>
            <td> <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
            <td>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                    Delete
                </button>
            </form>
            </td>
        </tr>
 @endforeach
 </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#search, #minAge, #maxAge').on('keyup change', function() {
        let query = $('#search').val().trim(); 
        let minAge = $('#minAge').val().trim();
        let maxAge = $('#maxAge').val().trim(); 

        $.ajax({
            url: '/students',
            method: 'GET',
            data: { 
                search: query,
                minAge: minAge,
                maxAge: maxAge 
            },
            dataType: 'json',
            success: function(response) {
                console.log("Students Data:", response); 
                let studentData = '';

                if (response.length > 0) {
                    response.forEach(function(student) {
                        studentData += `                      
                        <tr>
                            <td>${student.id}</td>
                            <td>${student.name}</td>
                            <td>${student.age}</td>
                            <td><a href="/students/${student.id}" class="btn btn-info btn-sm">View</a></td>
                            <td><a href="/students/${student.id}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                            <td>
                            <form action="/students/${student.id}" method="POST" onsubmit="return confirm('Are you sure?')">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            </td>
                            </tr>`;
                    });
                } else {
                    studentData = `<tr><td>No students found</td></tr>`;
                }

                $('#studentTable').html(studentData);
            },
            error: function(xhr, status, error) {
                console.log("Error fetching students:", xhr.responseText); 
            }
        });
    });
});

</script>
@endsection
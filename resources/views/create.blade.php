@extends('layout')
@section('title', 'Add Student')
@section('content')
<h2>Add New Student</h2>
<form method="POST" action="{{ route('students.store') }}" class="mt-3">
    @csrf
    <div class="mb-3">
        <input type="text" class="form-control" name="name" placeholder="Name">
    </div>
    <div class="mb-3">
        <input type="number" class="form-control" name="age" placeholder="Age">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

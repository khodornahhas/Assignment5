@extends('layout')
@section('title', 'Home')
@section('content')
<h1 class="text-center">Welcome to Laravel Kickstart</h1>
<div class="text-center mt-4">
    <!-- TODO: Add buttons to view/add students -->
    <a href="/students" class="btn btn-primary btn-sm">View Student</a>
    <a href="{{route('students.create')}}" class="btn btn-success btn-sm">Add Student</a>
</div>
@endsection
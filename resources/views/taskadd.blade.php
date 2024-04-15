@extends('layouts.master')
@section('title', 'taskadd')
@section('content')
    <div class="container">
        <h2>Add Task</h2>
        <form action="{{ route('add.insert') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="task_name">Task Name:</label>
                <input type="text" class="form-control" id="task_name" name="task_name">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" class="form-control" id="due_date" name="due_date">
            </div><br>
            <button type="submit" class="btn btn-primary">Add New Task</button>
        </form>
    </div>

@endsection

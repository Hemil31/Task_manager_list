@extends('layouts.master')
@section('title', 'Homepage')
@section('content')
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Sr.no</th>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $id = 1;
                @endphp
                <!-- Your table rows will be dynamically generated based on your database entries -->
                @foreach ($userdata as $task)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $task->task_name }}</td>
                        <td style="max-width: 100px; word-wrap: break-word;">{{ $task->description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            <form action="{{ route('tasks.update-status', $task->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>To Do</option>
                                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('delete', $task->id) }}" class="btn btn-danger"> Delete </a>
                            <a href="{{ route('edit', $task->id) }}" class="btn btn-danger"> Edit </a>
                        </td>
                    </tr>
                @endforeach



                <!-- You will have more rows if you have more tasks -->
            </tbody>
        </table>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f9f7f7, #dbe2ef, #3f72af);
            font-family: 'Poppins', sans-serif;
            color: #333;
            min-height: 100vh;
        }

        .container {
            max-width: 850px;
            background: #ffffffcc;
            backdrop-filter: blur(5px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            margin-top: 60px;
        }

        h1 {
            font-weight: 600;
            color: #112d4e;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #3f72af;
            border: none;
        }

        .btn-primary:hover {
            background-color: #265075;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        th {
            background-color: #3f72af;
            color: #fff;
        }

        tr:hover {
            background-color: #eef2f7;
        }

        .badge {
            font-size: 0.9em;
            padding: 6px 10px;
        }

        .footer-text {
            text-align: center;
            color: #555;
            font-size: 14px;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Task Management System</h1>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add Task</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td class="fw-semibold">{{ $task->title }}</td>
                    <td>
                        @if($task->priority == 'High')
                            <span class="badge bg-danger">High</span>
                        @elseif($task->priority == 'Medium')
                            <span class="badge bg-warning text-dark">Medium</span>
                        @else
                            <span class="badge bg-success">Low</span>
                        @endif
                    </td>
                    <td>
                        @if($task->status == 'Completed')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-warning">✏️</a>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-muted py-3">No tasks added yet </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <p class="footer-text">Designed by Thanishka</p>
    </div>
</body>
</html>

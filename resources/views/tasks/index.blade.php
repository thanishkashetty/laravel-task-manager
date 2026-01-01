<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f6f8fb;
            font-family: 'Poppins', sans-serif;
            color: #2d3748;
        }

        .container {
            max-width: 1000px;
            background: #ffffff;
            border-radius: 14px;
            padding: 35px 40px;
            margin-top: 60px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
            font-weight: 600;
            color: #1a365d;
            margin-bottom: 30px;
        }

        /* Buttons */
        .btn-primary {
            background-color: #3f72af;
            border: none;
            border-radius: 6px;
        }
        .btn-primary:hover {
            background-color: #2b507a;
        }
        .btn-secondary {
            background-color: #9da9bb;
            border: none;
            border-radius: 6px;
        }
        .btn-secondary:hover {
            background-color: #6c757d;
        }

        /* Table Styling */
        table {
            border-radius: 10px;
            overflow: hidden;
        }
        thead {
            background-color: #3f72af;
            color: white;
        }
        th, td {
            vertical-align: middle !important;
        }
        tr:hover {
            background-color: #f1f5fb;
        }

        /* Badges */
        .badge {
            font-size: 0.85em;
            padding: 6px 10px;
            border-radius: 8px;
        }
        .priority-low { background: #e7f9ed; color: #2b8a3e; }
        .priority-medium { background: #fff4e6; color: #d97706; }
        .priority-high { background: #fdecec; color: #b91c1c; }

        .status-pending { background: #e2e8f0; color: #334155; }
        .status-completed { background: #d1fae5; color: #047857; }

        .progress {
            height: 20px;
            border-radius: 10px;
            background-color: #e9ecef;
            margin-bottom: 20px;
        }

        .progress-bar {
            font-weight: 500;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
        }

        .due-date {
            font-size: 0.9em;
            color: #555;
        }

        .action-btn {
            border: none;
            background: none;
            padding: 5px 8px;
            border-radius: 6px;
            transition: 0.2s ease;
        }
        .action-btn:hover {
            background: #f1f5fb;
        }
        .action-btn i {
            font-size: 1rem;
        }

        .alert {
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Task Management System</h1>

        <!-- Filter Section -->
        <form method="GET" action="{{ route('tasks.index') }}" class="row g-2 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="Pending" {{ (isset($status) && $status == 'Pending') ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ (isset($status) && $status == 'Completed') ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="priority" class="form-select">
                    <option value="">All Priority</option>
                    <option value="Low" {{ (isset($priority) && $priority == 'Low') ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ (isset($priority) && $priority == 'Medium') ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ (isset($priority) && $priority == 'High') ? 'selected' : '' }}>High</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-primary flex-fill">Apply</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary flex-fill">Reset</a>
            </div>
        </form>

        <!-- Progress -->
        @if(isset($progress))
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%">
                    {{ round($progress) }}% Completed
                </div>
            </div>
        @endif

        <!-- Stats -->
        @php
            $pendingCount = $tasks->where('status', 'Pending')->count();
            $completedCount = $tasks->where('status', 'Completed')->count();
        @endphp
        <div class="text-center mb-3">
            <span class="badge status-pending">Pending: {{ $pendingCount }}</span>
            <span class="badge status-completed">Completed: {{ $completedCount }}</span>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add Task</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- Tasks Table -->
        <table class="table table-bordered table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td class="fw-semibold">{{ $task->title }}</td>
                    <td>
                        <span class="badge 
                            {{ $task->priority == 'High' ? 'priority-high' : ($task->priority == 'Medium' ? 'priority-medium' : 'priority-low') }}">
                            {{ $task->priority }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $task->status == 'Completed' ? 'status-completed' : 'status-pending' }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td class="due-date">
                        @if($task->due_date)
                            <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            @if($task->status == 'Pending')
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="action-btn text-success" title="Mark Completed">
                                        <i class="bi bi-check2-circle"></i>
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('tasks.edit', $task->id) }}" class="action-btn text-warning" title="Edit Task">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn text-danger" title="Delete Task">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-muted py-3">No tasks added yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <p class="footer-text">© {{ date('Y') }} Task Manager | Designed by <b>Thanishka</b></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

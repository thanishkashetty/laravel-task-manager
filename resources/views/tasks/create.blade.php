<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f9f7f7, #dbe2ef, #3f72af);
            font-family: 'Poppins', sans-serif;
            color: #333;
            min-height: 100vh;
        }
        .container {
            max-width: 700px;
            background: #ffffffcc;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            margin-top: 70px;
        }
        h1 {
            font-weight: 600;
            color: #112d4e;
            text-align: center;
            margin-bottom: 25px;
        }
        .btn-primary {
            background-color: #3f72af;
            border: none;
        }
        .btn-primary:hover {
            background-color: #265075;
        }
        .btn-secondary {
            background-color: #adb5bd;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #8c939b;
        }
        label {
            font-weight: 500;
            color: #112d4e;
        }
        .footer-text {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 20px;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create New Task</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Task Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                    <select name="priority" id="priority" class="form-select" required>
                        <option value="">Select Priority</option>
                        <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Task</button>
            </div>
        </form>

        <p class="footer-text">© {{ date('Y') }} Task Manager | Designed by <b>Thanishka</b></p>
    </div>
</body>
</html>

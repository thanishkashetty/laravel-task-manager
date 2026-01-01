<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #dbe2ef, #3f72af);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 500px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border: none;
        }

        .card-body {
            padding: 35px;
        }

        h2 {
            text-align: center;
            color: #112d4e;
            font-weight: 600;
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
            background-color: #9da9bb;
            border: none;
        }

        .form-label {
            font-weight: 500;
            color: #112d4e;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h2>➕ Add New Task</h2>

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Priority</label>
                    <select name="priority" class="form-select" required>
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary">Save Task</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display tasks with filters and sorting
    public function index(Request $request)
    {
        // Collect filters
        $search = $request->input('search');
        $status = $request->input('status');
        $priority = $request->input('priority');

        // Query with conditions and sort by due_date first
        $tasks = Task::query()
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($priority, fn($q) => $q->where('priority', $priority))
            ->orderByRaw("CASE WHEN due_date IS NULL THEN 1 ELSE 0 END") // null due dates go last
            ->orderBy('due_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate progress
        $total = Task::count();
        $completed = Task::where('status', 'Completed')->count();
        $progress = $total > 0 ? ($completed / $total) * 100 : 0;

        // Send data to view
        return view('tasks.index', compact('tasks', 'search', 'status', 'priority', 'progress'));
    }

    // Show create task form
    public function create()
    {
        return view('tasks.create');
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:Low,Medium,High',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'Pending',
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show edit task form
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Update an existing task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:Low,Medium,High',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    // Mark task as completed
    public function markCompleted($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'Completed';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }

    // Redirect show to index (not used)
    public function show(Task $task)
    {
        return redirect()->route('tasks.index');
    }
}

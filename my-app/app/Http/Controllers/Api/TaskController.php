<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Tasks loaded successfully',
            'data' => $tasks,
        ]);
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'title' => 'required|string|max:255',
        ]);
        $task=Task::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => $task,
        ], 201);
    }

    public function complete(Task $task)
    {
        $task->update([
            'is_completed' => true,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Task completed successfully',
            'data' => $task,
        ]);
    }
   public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $task->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $task,
        ]);
    }
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
        ]);
    }
}

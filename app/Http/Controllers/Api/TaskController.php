<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['creator', 'responsible'])
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $validated['created_user_id'] = auth()->id();

        $task = Task::create($validated);

        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        return new TaskResource($task->load(['creator', 'responsible']));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => __('messages.task.deleted')]);
    }
} 
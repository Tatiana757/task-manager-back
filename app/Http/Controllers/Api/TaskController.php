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
        $this->authorize("view-tasks");

        $tasks = Task::with(['creator', 'responsible'])
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $request)
    {
        $this->authorize("create-tasks");

        $validated = $request->validated();
        $validated['created_user_id'] = auth()->id();

        $task = Task::create($validated);

        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        $this->authorize("view-tasks");
        
        return new TaskResource($task->load(['creator', 'responsible']));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize("edit-tasks");

        if (!auth()->user()->can('change-task-status')) {
            $request->offsetUnset('status');
        }
        
        if ($request->has('responsible_user_id') && !auth()->user()->can('assign-task-responsible')) {
            $request->offsetUnset('responsible_user_id');
        }

        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $this->authorize("delete-tasks");

        $task->delete();

        return response()->json(['message' => __('messages.task.deleted')]);
    }
} 
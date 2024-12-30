@extends('layouts.admin')

@section('title', __('entities/task.edit'))

@section('content')
<div class="container px-6 py-8 mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">{{ __('entities/task.edit') }}</h2>
        </div>

        <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6">
                <div>
                    <label for="title" class="text-base text-gray-700">{{ __('entities/task.title') }}</label>
                    <input type="text" 
                           name="title" 
                           id="title"
                           value="{{ old('title', $task->title) }}"
                           class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="text-base text-gray-700">{{ __('entities/task.description') }}</label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                    >{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="text-base text-gray-700">{{ __('entities/task.status') }}</label>
                    <select name="status" 
                            id="status" 
                            class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                    >
                        <option value="pending" @selected(old('status', $task->status) == 'pending')>{{ __('entities/task.status_pending') }}</option>
                        <option value="in_progress" @selected(old('status', $task->status) == 'in_progress')>{{ __('entities/task.status_in_progress') }}</option>
                        <option value="completed" @selected(old('status', $task->status) == 'completed')>{{ __('entities/task.status_completed') }}</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="responsible_user_id" class="text-base text-gray-700">{{ __('entities/task.responsible_user') }}</label>
                    <select name="responsible_user_id" 
                            id="responsible_user_id" 
                            class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('responsible_user_id') border-red-500 @enderror"
                    >
                        <option value="">{{ __('common.select') }}</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @selected(old('responsible_user_id', $task->responsible_user_id) == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('responsible_user_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-right">
                <a href="{{ route('admin.tasks.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    {{ __('button.cancel') }}
                </a>
                <button type="submit" class="ml-3 px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                    {{ __('button.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
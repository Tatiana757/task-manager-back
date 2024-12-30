@extends('layouts.admin')

@section('title')
{{ __('nav.tasks') }}
@endsection

@section('content')
<div class="container px-6 py-8 mt-8">
    
    @include('admin.notification')

    <div class="mb-4">
        <a href="{{ route('admin.tasks.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 no-underline">
            {{ __('entities/task.add') }}
        </a>
    </div>

    <div class="overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th
                        class="px-2 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        #</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('entities/task.title') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('entities/task.description') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('entities/task.status') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('entities/task.created_user') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('entities/task.responsible_user') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('common.created_at') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('common.actions') }}
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @foreach($tasks as $task)
                    <tr>
                        <td class="px-2 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="text-sm leading-5 text-gray-900">{{ $task->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="text-sm leading-5 text-gray-900">{{ $task->title }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="text-sm leading-5 text-gray-900">{{ $task->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($task->status === 'completed') bg-green-100 text-green-800
                                @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ __('entities/task.status_' . $task->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="text-sm leading-5 text-gray-900">{{ $task->creator->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="text-sm leading-5 text-gray-900">{{ $task->responsible->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="text-sm leading-5 text-gray-900">{{ formatDate($task->created_at) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="{{ route('admin.tasks.edit', $task) }}" 
                                   class="inline-flex items-center px-3 py-1 text-gray-700 hover:text-gray-900 no-underline">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    {{ __('button.edit') }}
                                </a>

                                <button type="button" 
                                        onclick="document.getElementById('confirmDelete{{ $task->id }}').classList.remove('hidden')"
                                        class="inline-flex items-center px-3 py-1 text-red-600 hover:text-red-800 no-underline">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    {{ __('button.delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                    <x-modal.confirm-delete :task="$task" />
                @endforeach
            </tbody>
        </table>
        {{ $tasks->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
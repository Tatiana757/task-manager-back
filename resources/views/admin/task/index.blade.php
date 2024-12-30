@extends('layouts.admin')

@section('title')
{{ __('nav.tasks') }}
@endsection

@section('content')
<div class="container px-6 py-8 mt-8">
    
    @include('admin.notification')

    <div class="mb-4">
        <a href="{{ route('admin.tasks.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 no-underline">
            {{ __('task.add') }}
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
                        {{ __('task.title') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('task.description') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('task.created_user') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('task.responsible_user') }}</th>
                    <th
                        class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('common.created_at') }}</th>
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
                            <div class="text-sm leading-5 text-gray-900">{{ $task->created_user_id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="text-sm leading-5 text-gray-900">{{ $task->responsible_user_id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                            <div class="text-sm leading-5 text-gray-900">{{ formatDate($task->created_at) }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tasks->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
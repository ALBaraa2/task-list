@extends('layouts.app')

@section('title', 'The list of tasks')

@section('contant')

<div>
    <a href="{{ route('tasks.create') }}">Add Task</a>
</div>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('task.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse

    @if ($tasks->count())
        <nav>
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection

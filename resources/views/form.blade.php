@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('contant')
<form action="{{isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" method="POST">
    @csrf
    @isset($task)
        @method('PUT')
    @endisset
    <div class="mb-4">
        <label for="title">Title</label>
        <input type="text" name="title" id="title"
        {{-- @class(['border-red-500' => $errors->has('title')]) --}}
        class="@error('title') border-red-500 @enderror "
        value="{{ $task->title ?? old('title') }}">
        @error('title')
        <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description">Descriptiom</label>
        <textarea name="description" id="description" rows="5"
        @class(['border-red-500' => $errors->has('description')])>{{ $task->description ?? old('description') }}</textarea>
        @error('description')
        <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="long_description">Long_Descriptiom</label>
        <textarea name="long_description" id="long_description" rows="10"
        @class(['border-red-500' => $errors->has('long_description')])>{{ $task->long_description ?? old('long_description') }}</textarea>
    </div>

    <div class="flex gap-2 items-center">
        <button type="submit" class="btn">
            @isset($task)
                Update Task
            @else
                ADD Task
            @endisset
        </button>
        <a href="{{ route('task.index') }}" class="link">Cancel</a>
    </div>
</form>
@endsection

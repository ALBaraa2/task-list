@extends('layouts.app')
<!--Hello i am a blade template!-->

@section('title', 'The list of tasks')

<!--to access to data that passed from route use double {}-->
{{-- <div> name is: {{ $name }}</div> --}}

{{-- this print <b>ID<b> --}}
{{-- {{ $id }} --}}

{{--we use @ isset() to check is the data passed from route or not --}}
    {{-- @isset($test)
        <div>Test {{ $test }}</div>
    @endisset

    @isset($hi) --}}
        {{-- <div>no passed {{ $hi }}</div> --}}
    {{-- @endisset --}}
@section('contant')
<div>
    {{-- @if (count($tasks)) --}}
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('task.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse
        {{-- @foreach ($tasks as $task)
            <div>{{ $task->title }}</div>
        @endforeach
    @else
        <div>There are no tasks!</div>
    @endif --}}
</div>
@endsection

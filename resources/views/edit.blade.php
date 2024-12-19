@extends('layouts.app')

@section('contant')
    @include('form', ['task' => $task])
@endsection

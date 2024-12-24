<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use \App\Models\Task;


Route::get('/', function () {
    return redirect()->route('task.index');
});
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate()
    ]);
})->name('task.index');

Route::view('/tasks/create','create')->name('tasks.create');

Route::post('/tasks', function (TaskRequest $request) {

    $task = Task::create($request->validated());

    return redirect()->route('task.show', ['task'=> $task->id])
        ->with('success', 'Task created successfully!');

})->name('tasks.store');


Route::get('/tasks/{task}/edit', function (Task $task){

    return view('edit',[
        'task' => $task
    ]);
})->name('task.edit');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

    $task->update($request->validated());

    return redirect()->route('task.show', ['task'=> $task->id])
        ->with('success', 'Task Updated successfully!');

})->name('tasks.update');

Route::get('/tasks/{task}', function (Task $task){

    return view('show',[
        'task' => $task
    ]);
})->name('task.show');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('task.index')->with('success', 'Task Deleted successfully');
})->name('task.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully');
})->name('tasks.toggle-complete');

// When you go to route does not exixst
Route::fallback(function () {
    return 'This Route dose no exist';
});

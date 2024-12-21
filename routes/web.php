<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use \App\Models\Task;
use Illuminate\Http\Request;


// class Task1
// {
//   public function __construct(
//     public int $id,
//     public string $title,
//     public string $description,
//     public ?string $long_description,
//     public bool $completed,
//     public string $created_at,
//     public string $updated_at
//   ) {
//   }
// }

// $tasks = [
//   new Task1(
//     1,
//     'Buy groceries',
//     'Task 1 description',
//     'Task 1 long description',
//     false,
//     '2023-03-01 12:00:00',
//     '2023-03-01 12:00:00'
//   ),
//   new Task1(
//     2,
//     'Sell old stuff',
//     'Task 2 description',
//     null,
//     false,
//     '2023-03-02 12:00:00',
//     '2023-03-02 12:00:00'
//   ),
//   new Task1(
//     3,
//     'Learn programming',
//     'Task 3 description',
//     'Task 3 long description',
//     true,
//     '2023-03-03 12:00:00',
//     '2023-03-03 12:00:00'
//   ),
//   new Task1(
//     4,
//     'Take dogs for a walk',
//     'Task 4 description',
//     null,
//     false,
//     '2023-03-04 12:00:00',
//     '2023-03-04 12:00:00'
//   ),
// ];

Route::get('/', function () {
    return redirect()->route('task.index');
});
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate()
    ]);
})->name('task.index');

Route::view('/tasks/create','create')->name('tasks.create');

// Route::get('/tasks/{id}', function ($id) use($tasks) {
//     $task = collect($tasks)->firstWhere('id', $id);
//     if (!$task) {
//      abort(Response::HTTP_NOT_FOUND);
//     }
//     return view('show', ['task' => $task]);
// })->name('task.show');


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

Route::post('/tasks', function (TaskRequest $request) {

    $task = Task::create($request->validated());

    return redirect()->route('task.show', ['task'=> $task->id])
        ->with('success', 'Task created successfully!');

})->name('tasks.store');


Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('task.index')->with('success', 'Task Deleted successfully');
})->name('task.destroy');

// When you go to route does not exixst
Route::fallback(function () {
    return 'This Route dose no exist';
});

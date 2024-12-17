<?php

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
    // return 'Main page';
    //pasing data to blade template use [key => value]
    return view('index', [
        // 'name' => 'ALBaraa',
        //if you passed data as html script the data will be
        //passed as you pass to as html script
        // 'id' => '<b>ID<b>',
        // 'test' => 'fsdfsdf',
        'tasks' => Task::latest()->get()
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

Route::get('/tasks/{id}', function ($id){

    return view('show',
    ['task' => Task::findOrFail($id)]);
})->name('task.show');

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();
    return redirect()->route('task.show', ['id'=> $task->id])
        ->with('success', 'Task created successfully!');

})->name('tasks.store');






// Route::get('/x', function () {
//     return 'hello';
// })->name('hello');

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

// Route::get('/rediract', function () {
//     // return redirect('/hello');
//     return redirect()->route('hello');
// });

// When you go to route does not exixst
Route::fallback(function () {
    return 'This Route dose no exist';
});

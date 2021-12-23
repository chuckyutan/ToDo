<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return inertia('Login');
});

Route::get('register', function () {
    return inertia('Register');
});



Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'registration'])->name('register');
Route::post('logout', [AuthController::class, 'destroy'])->name('logout')->middleware("auth");

Route::middleware("auth")->group(function  () {
    
    Route::get('/', function () {
        $searchedTasks = Task::where("user_id", auth()->user()->id)
        ->when(Request::input("search"), function($query, $search){
            $query->where("name", "like", "%{$search}%");
        })->get();




        $resultat = $searchedTasks
        ->sortByDesc("created_at")
        ->paginate(15)
        ->withQueryString()
        ->through(fn($task) => 
        [
            "id" => $task->id,
            "name" => $task->name,
            "created_at" => $task->created_at,
            "status" => $task->status,
            "user_id" => $task->user_id,
        ]);

        $statusStr = ["DO IT!", "doing it　(*^-^*)", "done!"]; 
    
         
        return inertia('App', [
            "name" => "Yuta",
            "tasks" => $resultat,
            "user" => auth()->user(),
            "status" => $statusStr,
    
            "filters" => Request::only(["search"])
        ]);
    });
    
    Route::post('/create', function (Request $request) {
        Request::validate([
            "name" => "required"
        ]);
    
        Task::create([
            "name" => request("name"),
            "user_id" => auth()->user()->id
        ]);
    
        return redirect("/")->with("message", 'Task Registered!');
    });
    
    Route::get('/task/{id}/delete', function ($id) {
        $task = Task::find($id);
        $task->delete();
        return back()->with ("deleted", "Task Deleted");
    });

    Route::get('/task/{id}/{status}/update', function ($id, $status) {
        $task = Task::find($id);
        $task->status = $status;
        $task->save();
        return back()->with ("edited", "Status edited");
    });
});


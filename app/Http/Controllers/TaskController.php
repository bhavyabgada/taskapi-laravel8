<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required',
        ]);

        $task = new Task();
        $task->task = $request->task;
        if($request->status){
            $task->status = $request->status;
        }
        $task = auth()->user()->tasks()->save($task);
        $task = auth()->user()->tasks()->find($task->id);
        if ($task)
            return response()->json([
                'success' => true,
                'data' => $task->toArray(),
                'status' => 1,
                'message' => 'Successfully created a task.'
            ]);
        else
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Task not added | Invalid API key.'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $task = auth()->user()->tasks()->find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }

        $updated = $task->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true,
                'data' => $task->toArray(),
                'status' => 1,
                'message' => 'Marked task as '.$task->status.'.'
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post can not be updated'
            ], 500);
    }

    public function dashboard()
    {
        $tasks = Task::where('user_id',Auth::id())->latest()->get();
        $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        return view('dashboard', ['tasks'=>$tasks, 'token'=>$token]);
    }
}
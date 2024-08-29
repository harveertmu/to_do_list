<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use Illuminate\Support\Facades\Validator;



class TaskController extends Controller
{
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|unique:tasks|max:255',
            'description' => 'nullable|string',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
      
            return response()->json([
                'success' => true,
                'message' => $validator->messages()->first()
            ]);
      

        } else {
            $task = Tasks::create($request->all());
            $tasks = Tasks::orderBy('id', 'desc')->get();

            return response()->json([
                'body' => view('tasks', ['tasks' => $tasks])->render(),
                'success' => 'status',
                'message' => 'Task created successfully!'
            ], 200);
        }
    }

    // Remove the specified task
    public function destroy(Tasks $task)
    {
        $task->delete();
        return redirect()->route('home')->with('success', 'Task deleted successfully.');
    }

    public function changeStatus(Tasks $task,$id)
    {
        $task = Tasks::findOrFail($id);
        $validatedData['completed']=1;
        $task->update($validatedData);

        return redirect()->route('home')->with('success', 'Status change successfully.');
    }

    //   changeStatus 
}

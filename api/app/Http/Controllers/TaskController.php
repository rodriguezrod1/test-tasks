<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Step 1: Try to retrieve all tasks from the database, ordered by 'id' in descending order
        try {
            $tasks = Task::orderBy('id', 'desc')->get();
            // Step 2: If successful, return a JSON response with the tasks
            return response()->json(["resp" => $tasks]);
        } catch (\Exception $e) {
            // Step 3: If an error occurs, return a JSON response with an error message
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $task = Task::create($request->validated());
            return response()->json([
                'resp' => $task,
                'message' => 'Task saved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);

            $task->status = $request->input('status');
            $task->save();

            return response()->json([
                'message' => 'Task edited successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json([
                'message' => 'Task delete successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}

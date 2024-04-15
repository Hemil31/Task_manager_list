<?php

namespace App\Http\Controllers;

use App\Models\Task_Manager;
use Illuminate\Http\Request;

class Task_Controller extends Controller
{
    /**
     * Summary of showAddForm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showAddForm()
    {
        // Return the view for adding a new task
        return view('taskadd');
    }

    /**
     * Summary of homePage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homePage()
    {
        // Fetch all tasks from the database based on the user's ID
        $userId = session()->get('user_id');
        $userdata = Task_Manager::where('user_id', $userId)->get();
        return view('home', compact('userdata'));
    }

    /**
     * Summary of addTask
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addTask(Request $request)
    {
        // Validate the request
        $userId = $request->session()->get('user_id');
        $task = new Task_Manager();
        $task->user_id = $userId;
        $task->task_name = $request->task_name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();
        return redirect()->route('home')->with('status', 'Task added successfully');
    }

    /**
     * Summary of deleteTask
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTask($id)
    {
        // Find the task by id and delete it
        Task_Manager::destroy($id);
        return redirect()->route('home')->with('status', 'Task deleted successfully');
    }


    /**
     * Summary of editTask
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editTask($id)
    {
        // Find the task by id and pass it to the view.
        $task = Task_Manager::find($id);
        return view('taskedit', compact('task'));
    }

    /**
     * Summary of updateTask
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTask(Request $request, $id)
    {
        // Validate the request
        $task = Task_Manager::find($id);
        // Update the task in database
        $task->task_name = $request->input('task_name');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->save();
        // Redirect back with updated
        return redirect()->route('home')->with('status', 'Task updated successfully');
    }

    /**
     * Summary of updateStatus
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:todo,in_progress,completed'
        ]);
        // Find the task by id
        $task = Task_Manager::find($id);
        // Update the status
        $task->status = $request->status;
        $task->save();
        // Redirect back or wherever you want
        return redirect()->back()->with('status', 'Status updated successfully.');
    }
}

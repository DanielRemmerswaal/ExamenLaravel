<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    public function create()
    {
        $userId = Auth::id();

        $tasks = Task::where('uid', $userId)->get();

        return view('dashboard', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'text' => 'required',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Task::create([
            'uid' => auth()->id(),
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|max:255',
            'text' => 'required',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $task = Task::findOrFail($request->input('id'));

        $task->title = $request->input('id');
        $task->text = $request->input('text');
        $task->deadline = $request->input('deadline');

        $task->save();

        return redirect()->back();
    }
}

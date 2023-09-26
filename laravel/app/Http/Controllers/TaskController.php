<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    // タスクの完了フラグの更新
    public function update(int $id)
    {
        $target_task = Task::find($id);

        // フラグだけ変更してDBに保存
        $target_task->completed = !$target_task->completed;
        $is_success = $target_task->save();

        return response()->json($is_success);
    }
}

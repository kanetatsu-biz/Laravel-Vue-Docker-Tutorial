<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

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

    // タスクの削除
    public function delete(int $id)
    {
        $delete_count = Task::destroy($id);

        return response()->json($delete_count === 1);
    }

    // タスクの新規登録
    public function create(Request $request)
    {
        $new_task = Task::create([
            'title' => $request->task_name,
        ]);

        return response()->json(!empty($new_task));
    }
}

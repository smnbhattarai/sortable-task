<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::orderBy('position')->get();
        return view('welcome', compact('tasks'));
    }

    public function reOrder(Request $request)
    {
        $movedTaskId = $request->movedTaskId;
        $new_order   = $request->newTaskOrder;

        $response = response()->json(['success']);

        $order_array = [];

        foreach ($new_order as $no) {
            $order_array[] = $no['id'];
        }

        $movedElementPosition = array_search($movedTaskId, $order_array);

        $previousTaskIdKey = $movedElementPosition - 1;
        $nextTaskIdKey     = $movedElementPosition + 1;

        // handle moved to first position
        $movedToFirstPosition = false;
        if ($movedElementPosition == 0) {
            $movedToFirstPosition = true;
        }

        // handle moved to last position
        $movedToLastPosition = false;
        if ($movedElementPosition == (count($order_array) - 1)) {
            $movedToLastPosition = true;
        }

        $previousElementId = null;
        if (!$movedToFirstPosition) {
            $previousElementId = $order_array[$previousTaskIdKey];
        }

        $nextElementId = null;
        if (!$movedToLastPosition) {
            $nextElementId = $order_array[$nextTaskIdKey];
        }


        // Get position for recalculation
        // Handle move to first position
        if ($movedToFirstPosition) {
            $previousTaskPosition = Task::where('id', $nextElementId)->value('position');
            $task                 = Task::findOrFail($movedTaskId);
            $task->position       = $previousTaskPosition / 2;
            $task->save();
            return $response;
        } // handle move to last position
        elseif ($movedToLastPosition) {
            $previousTaskPosition = Task::where('id', $previousElementId)->value('position');

            // swap position value of last and second last task
            $movedTask           = Task::findOrFail($movedTaskId);
            $movedTaskPosition   = $movedTask->position;
            $movedTask->position = $previousTaskPosition;
            $movedTask->save();

            $prevTask           = Task::findOrFail($previousElementId);
            $prevTask->position = $movedTaskPosition;
            $prevTask->save();

            return $response;
        } // handle move to position between two elements
        else {
            $nextTaskPosition     = Task::where('id', $nextElementId)->value('position');
            $previousTaskPosition = Task::where('id', $previousElementId)->value('position');

            $taskPositionNew     = ($nextTaskPosition + $previousTaskPosition) / 2;
            $movedTask           = Task::findOrFail($movedTaskId);
            $movedTask->position = $taskPositionNew;
            $movedTask->save();

            return $response;
        }

    }
}

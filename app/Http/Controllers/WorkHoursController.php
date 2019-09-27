<?php

namespace App\Http\Controllers;

use App\WorkHour;
use Illuminate\Http\Request;

class WorkHoursController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'start_hour' => 'required|date_format:H:i',
            'end_hour' => 'required|date_format:H:i',
            'max_overtime_hour' => 'required|integer',
            'promotions_hour' => 'required|min:0|integer'
        ]);

        $work_hour = WorkHour::create([
            'start_hour'        => $request->start_hour,
            'end_hour'          => $request->end_hour,
            'max_overtime_hour' => $request->max_overtime_hour,
            'promotions_hour'   => $request->promotions_hour
        ]);

        return response()->json($work_hour);
    }
}

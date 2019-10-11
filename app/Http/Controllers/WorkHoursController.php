<?php

namespace App\Http\Controllers;

use App\Salary;
use App\WorkHour;
use Illuminate\Http\Request;

class WorkHoursController extends Controller
{
    public function index(Request $request)
    {
        $salary = Salary::orderBy('id', 'DESC')->first();
        if ($salary)
            return response($salary->with(['workHour'])->get());
        else
            return response('No Salary in Database', 503);
    }

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

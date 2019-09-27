<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pay_amount' => 'required|min:0',
            'insurance' => 'required|min:0|max:100',
            'tax' => 'required|min:0|max:100',
            'penalty' => 'required|min:0',
            'reward' => 'required|min:0',
            'other' => 'required|min:0',
            'role_id' => 'required',
            'work_hour_id' => 'required'
        ]);

        $salary = Salary::create([
            'pay_amount'   => $request->pay_amount,
            'insurance'    => $request->insurance,
            'tax'          => $request->tax,
            'penalty'      => $request->penalty,
            'reward'       => $request->reward,
            'other'        => $request->reward,
            'role_id'      => $request->role_id,
            'work_hour_id' => $request->work_hour_id
        ]);

        return response()->json($salary);
    }
}

<?php

namespace App\Http\Controllers;

use App\Demand;
use App\Dismissal;
use App\Status;
use Illuminate\Http\Request;

class DemandsController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('manager')) {
            return response(Demand::whereIn('status_id', [5, 6, 7, 8])->get());
        } else if (auth()->user()->hasRole('supervisor')) {
            return response(Demand::whereIn('status_id', [1, 2, 3, 4, 5])->get());
        } else if (auth()->user()->hasRole('employee')) {
            return response(Demand::where('user_id', auth()->user()->id)->get());
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string'
        ]);

        $demand = Demand::create([
            'user_id' => auth()->user()->id,
            'message' => $request->message,
            'status_id' => 1,
            'subject' => $request->subject
        ]);

        return response($demand);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'status_id' => 'required|min:1|integer',
            'subject' => 'required|string',
        ]);

        $demand = Demand::find($id);
        $demand->update($request->only(['message', 'status_id', 'subject']));

        if (auth()->user()->hasAnyRole(['manager', 'supervisor'])) {
            $this->change_demand_level($request->type, $demand);
        }

        return response($demand);
    }

    private function change_demand_level($change_type = 'APPROVAL', $demand)
    {
        $current_demand_status = Status::find($demand->status_id);
        if ($change_type == 'APPROVAL') {
            if ($demand->status_id != 2 && $demand->status_id != 5)
                $demand->status_id = $current_demand_status->next_status_id;
        } else if ($change_type == 'REJECT') {
            $demand->status_id = 8;
        }

        $demand->save();
    }

    public function demand_visit_by_supervisor($id)
    {
        $demand = Demand::find($id);
        if (auth()->user()->hasRole('supervisor') && $demand->status_id == 1) {
            $demand->status_id = 2;
            $demand->save();
        } else {
            return response('دسترسی شما مجاز نیست', 401);
        }
    }

    public function create_dismissal(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'start_hour' => 'required|date_format:"H:i"',
            'end_hour' => 'required|date_format:"H:i"'
        ]);

        $demand = Demand::create([
            'user_id' => auth()->user()->id,
            'message' => $request->message,
            'status_id' => 1,
            'subject' => 'درخواست مرخصی'
        ]);

        $dismissal = Dismissal::create([
            'start_hour' => $request->start_hour,
            'end_hour' => $request->end_hour,
            'demand_id' => $demand->id
        ]);

        return response($dismissal);
    }

    public function update_dismissal($id, Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'start_hour' => 'required|date_format:"H:i"',
            'end_hour' => 'required|date_format:"H:i"'
        ]);

        $dismissal = Dismissal::find($id);
        $dismissal->update($request->only(['start_hour', 'end_hour']));

        $demand = Demand::find($dismissal->demand_id);
        $demand->update($request->only('message'));

        if (auth()->user()->hasAnyRole(['manager', 'supervisor'])) {
            $this->change_demand_level($request->type, $demand);
        }

        return response($dismissal);
    }

    public function dismissal_visit_by_supervisor($id)
    {
        $demand = Dismissal::find($id)->demand()->first();
        if (auth()->user()->hasRole('supervisor') && $demand->status_id == 1) {
            $demand->status_id = 2;
            $demand->save();
            return response($demand);
        } else {
            return response('دسترسی شما مجاز نیست', 401);
        }
    }
}

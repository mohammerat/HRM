<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Demand;
use App\User;
use App\WorkHour;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    public function store(Request $request)
    {
        if ($request->type == 'present') {
            $last_attendance = Attendance::whereHas('user', function ($query) use ($request) {
                $query->where('id', $request->user_id);
            })->orderBy('id', 'desc')->first();

            if ($last_attendance && $last_attendance->end_hour == '') {
                return response('شما مجاز به ورود مجدد نیستید.', 403);
            }

            $attendance = Attendance::create([
                'user_id' => $request->user_id,
                'start_hour' => strtotime('now'),
            ]);

            return response('ورود با موفقیت ثبت شد');
        } else if ($request->type == 'absent') {
            $last_attendance = Attendance::where('user_id', $request->user_id)->orderBy('id', 'desc')->first();

            if ($last_attendance && $last_attendance->end_hour != '') {
                return response('شما مجاز به خروج مجدد نیستید.', 403);
            }

            $last_attendance->end_hour = strtotime('now');

            if (($last_attendance->end_hour - $last_attendance->start_hour) < 0) {
                return response('خطایی رخ داده است', 500);
            }

            $last_attendance->works_mins = ($last_attendance->end_hour - $last_attendance->start_hour) / 60;
            $last_attendance->save();

            $this->isPromoted($request->user_id);

            return response('خروج با موفقیت ثبت شد');
        }
    }

    private function isPromoted($user_id)
    {
        $user = User::find($user_id);
        $role = $user->roles[0];
        $work_hour = WorkHour::orderBy('id', 'desc')->first();
        if (Demand::where('user_id', $user_id)->where('subject', 'ارتقا شغلی')->exists()) {
            $demand = Demand::where('user_id', $user_id)->where('subject', 'ارتقا شغلی')->orderBy('id', 'desc')->first();
            if (Attendance::where('updated_at', '>=', $demand->created_at)->where('user_id', $user_id)->where('works_mins', '!=', '')->sum('works_mins') > $work_hour->promotions_hour) {
                Demand::create([
                    'user_id' => $user_id,
                    'message' => 'کارمند با شماره پرسنلی ' . $user->personal_number . ' به سقف تعیین شده برای ارتثا شغلی دست یافته است.',
                    'status_id' => 5,
                    'subject' => 'ارتقا شغلی'
                ]);
            }
        } else {
            if (Attendance::where('works_mins', '!=', '')->where('user_id', $user_id)->sum('works_mins') > $work_hour->promotions_hour) {
                Demand::create([
                    'user_id' => $user_id,
                    'message' => 'کارمند با شماره پرسنلی ' . $user->personal_number . ' به سقف تعیین شده برای ارتثا شغلی دست یافته است.',
                    'status_id' => 5,
                    'subject' => 'ارتقا شغلی'
                ]);
            }
        }
    }

    public function this_month(Request $request)
    {
        $this_month_attendances = Attendance::where('user_id', $request->user_id)
            ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($request->year . '-' . $request->month . '-01 00:00:00')), date('Y-m-t H:i:s', strtotime($request->year . '-' . ($request->month) . ' 00:00:00'))])->get();
        return response()->json($this_month_attendances);
    }
}

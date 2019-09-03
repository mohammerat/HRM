<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function info()
    {
        return response(User::where('id', auth()->user()->id)->with('roles')->first());
    }

    public function show(Request $request)
    {
        if (auth()->user()->hasRole('manager')) {
            return User::role(['supervisor', 'employee'])->with('roles')->get();
        } else {
            return User::role('employee')->with('roles')->get();
        }
    }

    public function edit($id)
    {
        return User::where('id', $id)->with('roles')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'personal_number' => 'required|numeric|min:7',
            'melli_code' => 'required|digits:10',
            'birthdate' => 'required|date_format:"Y/m/d"',
            'password' => 'required|alpha_num|min:6'
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'personal_number' => $request->personal_number,
            'melli_code' => $request->melli_code,
            'birthdate' => $request->birthdate,
            'password' => $request->password
        ]);

        return response($user);
    }

    public function update(Request $request, $id)
    {
        $validation_rules = [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'personal_number' => 'required|numeric|min:7',
            'melli_code' => 'required|digits:10',
            'birthdate' => 'required|date_format:"Y/m/d"',
        ];
        if ($request->password) {
            $validation_rules['password'] = 'required|alpha_num|confirmed|min:6';
        }
        $request->validate($validation_rules);

        $user = User::find($id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->personal_number = $request->personal_number;
        $user->melli_code = $request->melli_code;
        $user->birthdate = $request->birthdate;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();

        return response($user);
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();

        return response('Successfully deleted');
    }
}

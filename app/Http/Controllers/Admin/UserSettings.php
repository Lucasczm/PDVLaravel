<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserSettings extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('admin.userSettings', ['user' => $user, 'success' => false]);
    }
    public function edit(Request $request)
    {
        $user = Auth::user();

        $errors = new \stdClass;
        $success = false;
        if ($request->password_confirmation != $request->password) {
            $errors->password_confirmation = "As senhas não combinam";
        } else {
            $user->username = ($request->username) ? $request->username : 'admin';
            $user->password = bcrypt($request->password);
            $success = $user->save();
        }

        return view('admin.userSettings', ['errors' => $errors, 'user' => $user, 'success' => $success]);
    }
}

<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends BaseController {


    public function index($id = 0){

        $users = User::all();

        return $this->ResponseSuccess($users);
    }

    public function store(Request $request){

        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'birthday' => 'required',
            'status' => 'required',
            'role' => 'required',
            'affiliate_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->ResponseError(0,'Invalid data.', 404);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->birthday = $request->input('birthday');
        $user->status = $request->input('status');
        $user->role = $request->input('role');
        $user->affiliate_id = $request->input('affiliate_id');
        $user->save();

        return $this->ResponseSuccess($user, '', 'User created successfully!');
    }

}

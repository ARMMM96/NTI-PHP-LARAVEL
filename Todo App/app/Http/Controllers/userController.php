<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\userModel;


class userController extends Controller {

    public function index() {



        $data =  userModel::orderBy('id', 'desc')->get();


        return view('users.index', ["data" => $data]);
    }




    public function create() {
        return view('users.create');
    }


    public function Store(Request $request) {

        $data =  $this->validate($request, [
            "name"     => "required|min:3",
            "email"    => "required|email",
            "password" => "required|min:6"
        ]);


        $data['password'] = bcrypt($data['password']);

        $op = userModel::create($data);

        if ($op) {
            $message = 'data inserted';
        } else {
            $message =  'error try again';
        }

        session()->flash('Message', $message);

        return redirect(url('/User/'));
    }



    public function edit($id) {


        $data = userModel::find($id);

        return view('users.edit', ["data" => $data]);
    }


    public function update(Request $request, $id) {


        $data =  $this->validate($request, [
            "name"     => "required|min:3",
            "email"    => "required|email"
        ]);

        $op =  userModel::where('id', $id)->update($data);

        if ($op) {
            $message = 'Raw Updated';
        } else {
            $message =  'error try again';
        }

        session()->flash('Message', $message);

        return redirect(url('/User/'));
    }





    public function delete($id) {

        $op =  userModel::find($id)->delete();
        if ($op) {
            $message = "Raw Removed";
        } else {
            $message = 'Error Try Again';
        }

        session()->flash('Message', $message);

        return redirect(url('/User/'));
    }




    public function login() {
        return view('users.login');
    }


    public function doLogin(Request $request) {

        $data =  $this->validate($request, [
            "password"  => "required|min:6",
            "email"     => "required|email"
        ]);


        if (auth()->attempt($data)) {
            return redirect(url('/User'));
        } else {
            session()->flash('Message', 'Plase Make sure that you entered correct email and password');
            return redirect(url('/User/Login'));
        }
    }




    public function LogOut() {

        auth()->logout();
        return redirect(url('/User/Login'));
    }
}

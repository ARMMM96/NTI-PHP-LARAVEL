<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\todoModel;

class todoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //

        $data = todoModel::join('users', 'users.id', '=', 'todos.user_id')->select('todos.*', 'users.name as userName')->get();

        return view('todos.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $data =   $this->validate($request, [
            "title"   => "required|max:100",
            "content" => "required|max:5000",
            "image"   => "required|image|mimes:png,jpg"    // file    // regex:

        ]);

        $FinalName = time() . rand() . '.' . $request->image->extension();

        if ($request->image->move(public_path('todoImages'), $FinalName)) {


            $data['image'] = $FinalName;
            $data['user_id'] = auth()->user()->id;

            $op = todoModel::create($data);

            if ($op) {
                $message = 'data inserted';
            } else {
                $message =  'error try again';
            }
        } else {
            $message = "Error In Uploading File ,  Try Again ";
        }

        session()->flash('Message', $message);

        return redirect(url('/Todo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        $data = todoModel::find($id);

        return view('todos.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //

        $data = todoModel::find($id);

        return view('todos.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //

        $data =   $this->validate($request, [
            "title"   => "required|max:100",
            "content" => "required|max:5000",
            "image"   => "nullable|image|mimes:png,jpg"

        ]);


        $objData = todoModel::find($id);


        if ($request->hasFile('image')) {

            $FinalName = time() . rand() . '.' . $request->image->extension();

            if ($request->image->move(public_path('todoImages'), $FinalName)) {

                unlink(public_path('todosImages/' . $objData->image));
            }
        } else {
            $FinalName = $objData->image;
        }


        $data['image'] = $FinalName;

        # Update OP ...

        $op = todoModel::find($id)->update($data);


        if ($op) {
            $message = 'Raw Updated';
        } else {
            $message =  'error try again';
        }

        session()->flash('Message', $message);

        return redirect(url('/Todo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        # Fetch Data
        $data =  todoModel::find($id);

        $op =  todoModel::find($id)->delete();
        if ($op) {
            unlink(public_path('todoImages/' . $data->image));
            $message = "Raw Removed";
        } else {
            $message = "Error Try Again";
        }

        session()->flash('Message', $message);

        return redirect(url('/Todo'));
    }
}

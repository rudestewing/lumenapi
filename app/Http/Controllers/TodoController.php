<?php

namespace App\Http\Controllers;

use App\Todo;
use Auth;

class TodoController extends Controller
{
    public function index()
    {
        $data = Todo::all();
        
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function create(Request $req)
    {
        $todo = new Todo;
        $todo->user_id = Auth::user()->id;
        $todo->content = $req->content;
        $todo->save();

        return response()->json([
            'data' => $todo
        ], 200);
    }

    public function update(Request $req, $id)
    {
        
    }

    public function delete(Request $req, $id)
    {
        
    }


}

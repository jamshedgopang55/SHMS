<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(){
        $data = Position::all();
        return view('admin.position.index',compact('data'));
    }
    public function store(request $req){
        $table = new Position();
        $table->name = $req->name;
        $table->save();
        return redirect()->route('admin.position.index');
    }
    public function edit($id){
        $data = Position::find($id);
        return view('admin.position.edit',compact('data'));
    }
    public function update(request $req){
        $table = Position::find($req->id);
        $table->name = $req->name;
        $table->update();
        return redirect()->route('admin.position.index');
    }
    public function destory($id){
        $Position = Position::find($id);
        $Position->delete();
        return redirect()->back();
    }
}

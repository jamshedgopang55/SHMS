<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;
use PDO;

class MilestoneController extends Controller
{
    public function index($id)
    {
        $project =  Project::findOrFail($id);

        $data = Milestone::where('project_id', $id)->get();
        if ($data ==  null) {
            abort(404);
        }
        return view('admin.milestone.index', compact('data', 'id'));
    }
    public function create($id)
    {
        $project = Project::with('ticket')->findOrFail($id);
        $receivedPrice =  Milestone::where('project_id',$id)->sum('price');


        return view('admin.milestone.create', compact('project','receivedPrice'));
    }
    public function store(request $req){
        $Milestone = new Milestone();
        $Milestone->description = $req->description;
        $Milestone->due_date = $req->due_date;
        $Milestone->project_id  = $req->project_id;
        $Milestone->price  = $req->price;
        $Milestone->save();
        return redirect()->route('admin.milestone.index',$Milestone->project_id);
    }
    public function edit($id)
    {
        $Milestone  = Milestone::findOrFail($id);
        // return $Milestone->project_id;
        $project = Project::with('ticket')->findOrFail( $Milestone->project_id);
        // return $project;
        $receivedPrice =  Milestone::where('project_id',$Milestone->project_id)->sum('price');
        // return $receivedPrice;

        return view('admin.milestone.edit', compact('Milestone','project','receivedPrice'));
    }

    public function update(Request $req){
        
        $Milestone = Milestone::findOrFail($req->id);
        $Milestone->description = $req->description;
        $Milestone->due_date = $req->due_date;
        $Milestone->price  = $req->price;
        $Milestone->save();
        return redirect()->route('admin.milestone.index',$Milestone->project_id);
    }
    public function destroy(Request $req){
        $Milestone = Milestone::findOrFail($req->id);
        $Milestone->delete();
        return redirect()->route('admin.milestone.index',$Milestone->project_id);
    }
}

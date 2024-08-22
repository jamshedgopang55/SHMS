<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:view project', ['only' => ['index']]);
        $this->middleware('permission:create project', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update project', ['only' => ['update','edit']]);
        $this->middleware('permission:delete project', ['only' => ['destroy']]);
    }




    public function index()
    {
        $projects = Project::get();
        return view('admin.project.index', compact('projects'));
    }
    public function create(Request $request)
    {
        $id =  $request->id;
        $ticket = Ticket::findOrFail($id);

        return view('admin.project.create', compact('id'));
    }
    public function store(Request $request)
    {
        // Validate the request data
      
        $rules = [
            'ticket_id' => 'required|string',
            'project_name' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today', // Start date must be today or later
            'end_date' => 'required|date|after_or_equal:start_date', // End date must be after or equal to start date
            'progress' => 'required|integer|min:0|max:100',
            'priority' => 'required|in:low,medium,high',
        ];


        try {
            $ticket = Ticket::findOrFail($request->ticket_id);
            $validator = Validator::make($request->all(), $rules);

            if ($validator->passes()) {
                $project = new Project();
                $project->ticket_id = $ticket->id;
                $project->name = $request->project_name;
                $project->start_date = $request->start_date;
                $project->end_date = $request->end_date;
                $project->progress = $request->progress;
                $project->priority = $request->priority;
                $project->assign_members = (!empty($request->assign_members) ? implode(',', $request->assign_members) : '');
                $project->save();

            }else{
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }
           
            return redirect()->route('admin.project.index')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions and redirect back with an error message
            return redirect()->back()->with('error', 'Error creating project: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        // return 'dsf';
        $project = Project::with('ticket')->findOrFail($id);
        $assign_members = [];

        // Check if assign_members field is not null
        if (!is_null($project->assign_members)) {
            // Explode the assign_members string into an array
            $membersArray = explode(',', $project->assign_members);

            // Query the Employee model to retrieve assigned members
            $assign_members = DB::table('employees')->whereIn('id', $membersArray)->get();
        }

        // Return the assigned members


        return view('admin.project.edit', compact('project', 'assign_members'));
    }
    public function update(Request $request)

    {

        $project = Project::findOrFail($request->id);



        $rules = [
            'ticket_id' => 'required|string',
            'project_name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date', 
            'progress' => 'required|integer|min:0|max:100',
            'priority' => 'required|in:low,medium,high',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $project->name = $request->project_name;
            $project->start_date = $request->start_date;
            $project->end_date = $request->end_date;
            $project->progress = $request->progress;
            $project->priority = $request->priority;
            $project->assign_members = (!empty($request->assign_members) ? implode(',', $request->assign_members) : '');
            $project->save();
        }else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


        return redirect()->route('admin.project.index')->with('success', 'Project updated successfully!');
    }
}

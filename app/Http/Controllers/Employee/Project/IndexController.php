<?php

namespace App\Http\Controllers\Employee\Project;

use App\Models\Ticket;
use App\Models\Project;
use App\Models\AssignMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {

        $employeeId = Auth::guard('employee')->user()->id;
        if (Auth::guard('employee')->user()->department->name == 'Seles') {
            $projects = Project::whereHas('ticket.employee', function ($query) use ($employeeId) {
                $query->where('employee_id', $employeeId);
            })->get();
        } else {


            $projects = Project::whereRaw("FIND_IN_SET('$employeeId', assign_members)")->get();
        };



        return view('employee.project.index', compact('projects'));
    }
}

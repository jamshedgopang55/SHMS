<?php

namespace App\Http\Controllers;


use App\Models\client;
use App\Models\Ticket;
use App\Models\Employee;
use App\Models\temp_file;
use App\Models\Attachment;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        $tickets =  Ticket::where('employee_id', Auth::guard('employee')->user()->id)->get();
        // return $tickets;
        return view('employee.ticket.index', compact('tickets'));
    }
    public function show($id)
    {

        $ticket = Ticket::findOrFail($id);
        $attachments = Attachment::with('tempFile')->where('ticket_id', $ticket->id)->get();


        // return $attachments;
        return view('employee.ticket.show', compact('ticket', 'attachments'));
    }
    public function create()
    {
        $data['departments'] = Department::all();
        $data['employees'] = Employee::all();
        return view('employee.ticket.create', $data);
    }
   
    public function store(Request  $request)
    {
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'company_name' => 'required',
            'country' => 'required',
            'mobile_number' => 'required',
            'employee_id' => 'required|numeric',
            'department_id' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'price' => 'required',
        ];
        
        if (!$request->has('client_id')) {
            $rules['email'] .= '|unique:clients,email';
        }
        

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            ////Create client if not exist
            $client_id = $request->client_id;
            if (!$request->has('client_id')) {
                $request->client;
                $client = new client();
                $client->first_name = $request->fname;
                $client->last_name = $request->lname;
                $client->street_address_1 = $request->street_address_1;
                $client->email = $request->email;
                $client->company_name = $request->company_name;
                $client->country = $request->country;
                $client->mobile_number = $request->mobile_number;
                $client->save();
                $client_id = $client->id;
            }



            $ticket = new Ticket();
            $ticket->employee_id = $request->employee_id;
            $ticket->client_id = $client_id;
            $ticket->department_id = $request->department_id;
            $ticket->sub_department_id = $request->sub_department_id;
            $ticket->subject = $request->subject;
            $ticket->description = $request->description;
            $ticket->priority = $request->priority;
            $ticket->price = $request->price;;
            $ticket->status = "Open";
            $ticket->save();
            
            if (!empty($request->images_array)) {
                foreach ($request->images_array as $temp_img_id) {
                    $temp_img = temp_file::find($temp_img_id);
                    $ext = last(explode('.', $temp_img->name));
                    $attachment = new Attachment();
                    $attachment->ticket_id = $ticket->id;
                    $attachment->temp_id = $temp_img->id;
                    $attachment->source = 'NULL';
                    $attachment->save();
                }
            }

            return redirect()->back();
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}

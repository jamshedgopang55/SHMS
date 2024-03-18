<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\temp_file;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('status','Open')->get();
        // return $tickets;
        return view('admin.ticket.index', compact('tickets'));
    }
    public function accepted()
    {
        $tickets = Ticket::where('status','accepted')->get();
        // return $tickets;
        return view('admin.ticket.accepted', compact('tickets'));
    }
    public function rejected()
    {
        $tickets = Ticket::where('status','rejected')->get();
        // return $tickets;
        return view('admin.ticket.rejected', compact('tickets'));
    }
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $attachments = Attachment::with('tempFile')->where('ticket_id', $ticket->id)->get();
        return view('admin.ticket.show', compact('ticket', 'attachments'));
    }
    public function accept(Ticket $ticket)
    {
        $ticket->status = 'accepted';
        $ticket->save();
        return redirect()->back()->with('success', 'Ticket accepted successfully.');
    }

    // Method to reject a ticket
    public function reject(Ticket $ticket)
    {
        $ticket->status = 'rejected';
        $ticket->save();
        return redirect()->back()->with('success', 'Ticket rejected successfully.');
    }
}

<h1>Ticket Details</h1>

<ul>
    <li>ID: {{ $ticket->id }}</li>
    <li>Employee ID: {{ $ticket->employee_id }}</li>
    <li>Employee Name: {{ $ticket->employee->name }}</li> 
    <td>{{ $ticket->department->name }}</td>
    <td>{{ $ticket->subDepartment->name  ?? 'N/A'}}</td>
  
    <li>Subject: {{ $ticket->subject }}</li>
    <li>Description: {{ $ticket->description }}</li>
    <li>Priority: {{ $ticket->priority }}</li>
    <li>Price: {{ $ticket->price }}</li>
    <li>Status: {{ $ticket->status }}</li>
    <li>Created At: {{ $ticket->created_at }}</li>
    <li>Updated At: {{ $ticket->updated_at }}</li>
</ul>
@foreach ($attachments as $attachment)
    <div>
        @php
            $extension = pathinfo($attachment->tempFile->source, PATHINFO_EXTENSION);
        @endphp
        @if (in_array($extension, ['png', 'jpeg', 'jpg', 'gif']))
            <img src="{{ asset('temp/' . $attachment->tempFile->source) }}" alt="Attachment Image"
                style="max-width: 200px; max-height: 200px;">
            <a href="{{ asset('temp/' . $attachment->tempFile->source) }}" download>
                <button>Download {{ strtoupper($extension) }} File</button>
            </a>
        @elseif(in_array($extension, ['docx', 'xls', 'xlsx', 'zip']))
            <a href="{{ asset('temp/' . $attachment->tempFile->source) }}" download>
                <button>Download {{ strtoupper($extension) }} File</button>
            </a>
        @elseif($extension === 'pdf')
            <embed src="{{ asset('temp/' . $attachment->tempFile->source) }}" type="application/pdf" width="200"
                height="200" />
            <a href="{{ asset('temp/' . $attachment->tempFile->source) }}" download>
                <button>Download {{ strtoupper($extension) }} File</button>
            </a>
        @elseif($extension === 'zip')
            <a href="{{ asset('temp/' . $attachment->tempFile->source) }}" download>
                <button>Download ZIP File</button>
            </a>
        @else
            <p>Unsupported file type: {{ $extension }}</p>
        @endif
    </div>
@endforeach




@if ($ticket->status === 'Open')
    <form action="{{ route('admin.ticket.accept', $ticket->id) }}" method="POST" style="display: inline;">
        @csrf
        <!-- Form fields -->
        <button type="submit" class="btn btn-success">Accept</button>
    </form>

    <form action="{{ route('admin.ticket.reject', $ticket->id) }}" method="POST" style="display: inline;">
        @csrf
        <!-- Form fields -->
        <button type="submit" class="btn btn-danger">Reject</button>
    </form>
@elseif($ticket->status === 'accepted')
    <form action="{{ route('admin.ticket.reject', $ticket->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Reject</button>
    </form>
@elseif($ticket->status === 'rejected')
    <form action="{{ route('admin.ticket.accept', $ticket->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-success">Accept</button>
    </form>
@endif

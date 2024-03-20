<h1>Ticket Details</h1>

<ul>
    <li>ID: {{ $ticket->id }}</li>
    <li>Employee ID: {{ $ticket->employee_id }}</li>
    <li>Employee Name: {{ $ticket->employee->name }}</li> 
    <li>department name :{{ $ticket->department->name }}</li>
    <li> sub department name :{{ $ticket->subDepartment->name  ?? 'N/A'}}</li>
    <li>Client Name: {{ $ticket->client_name }}</li>
    <li>Client Email: {{ $ticket->client_email }}</li>
    <li>Client Phone: {{ $ticket->client_phone }}</li>
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




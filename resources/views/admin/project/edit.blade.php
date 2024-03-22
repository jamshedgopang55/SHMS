@extends('admin.layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Create Project</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.project.update') }}">
                            @csrf
                           <input name="id" type="number" hidden value="{{$project->id}}">
                        
                            <div  class="form-group">
                                <label for="ticket_id">Ticket ID:</label>
                                <input readonly type="text" name="ticket_id" id="ticket_id" value="{{ $project->ticket_id }}" class="form-control" required>
                            </div>

                             <div class="form-group">
                                <label >sales</label>
                                <input disabled type="text"  class="form-control" value="{{$project->ticket->employee->name}}" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="project_name">Project Name:</label>
                                <input type="text" name="project_name" id="project_name" class="form-control" value="{{ $project->name }}" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $project->start_date }}" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $project->end_date }}" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="progress">Progress/Completion:</label>
                                <input type="range" name="progress" id="progress" class="form-control-range" required min="0" max="100" value="{{ $project->progress }}">
                            </div>
                        
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Assign members</h2>
                                    <div class="mb-3">
                                        <select multiple class="assign_members w-100" name="assign_members[]" id="assign_members">
                                            @if(isset($assign_members))
                                            @if ($assign_members->isNotEmpty())
                                                @foreach ($assign_members as $assign_member)
                                                <option selected value="{{$assign_member->id}}">{{$assign_member->name}}</option>
                                                @endforeach
                                            @endif
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label for="priority">Priority:</label>
                                <select name="priority" id="priority" class="form-control" required>
                                    <option value="low" {{ $project->priority == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $project->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $project->priority == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                            @can('update workFromHomePermission')
                            <button type="submit" class="btn btn-primary">Update Project</button>
                            @endcan
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script>
        $('#assign_members').select2({
         ajax: {
             url: '{{ route('admin.getEmployee') }}',
             dataType: 'json',
             tags: true,
             multiple: true,
             minimumInputLength: 3,
             processResults: function(data) {
                 return {
                     results: data.tags
                 };
             }
         }
     });

    </script>
@endsection

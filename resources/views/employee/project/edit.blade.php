
    <div class="container">
        <h1>Edit Project</h1>
        <form method="POST" action="{{ route('admin.project.store') }}">
            @csrf
            @method('POST')
            <input type="number" hidden  name="id" id="" value="{{$project->id}}">
            <div class="form-group">
                <label for="ticket_id">Ticket ID:</label>
                <input type="text" name="ticket_id" id="ticket_id" class="form-control" value="{{ $project->ticket_id }}" required>
            </div>

            <div class="form-group">
                <label for="stage">Stage:</label>
                <input type="text" name="stage" id="stage" class="form-control" value="{{ $project->stage }}" required>
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
                <input type="range" name="progress" id="progress" class="form-control" value="{{ $project->progress }}" required min="0" max="100">
            </div>

            <div class="form-group">
                <label for="priority">Priority:</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="low" {{ $project->priority === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $project->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $project->priority === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>
    </div>

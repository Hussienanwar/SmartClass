@extends('layouts.master')

@section('content')
<div class="container mt-5">
    
@if(session('success'))
<div class="alert alert-success text-center mt-3">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger mt-3">
    <h5>Import Errors:</h5>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if ($errors->has('errors'))
<div class="alert alert-danger mt-3">
    <h5>Import Errors:</h5>
    <ul>
        @foreach ($errors->get('errors') as $errorMessage)
            <li>{{ $errorMessage }}</li>
        @endforeach
    </ul>
</div>
@endif

    <div class="card shadow-lg p-4">
        <h3 class="mb-4 text-center">Attendance Management</h3>

        {{-- Attendance Form --}}
        <form action="{{ route('attendance.store', $room->id) }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Enter Attendance Name" required>
                <button type="submit" class="btn btn-primary btn-create">
                    <i class="fas fa-plus"></i> Create Attendance
                </button>
            </div>
        </form>

        {{-- Attendance Cards --}}
        <div class="mt-3">
            @foreach ($room->attendanceCards as $card)
                <div class="row">
                    <div class="col-12">
                        <div class="card attendance-card mb-3 shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1"><i class="fas fa-calendar-check text-primary"></i> {{ $card->name }}</h5>
                                    <small class="text-muted">Created on: {{ $card->created_at->format('Y-m-d') }}</small>
                                </div>
                                <div class="card-actions">
                                    <a href="#" class="text-primary"><i class="fas fa-eye"></i> View</a>
                                    <a href="#" class="text-warning"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="text-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Students Table --}}
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Students Attendance</h5>
                    <div class="table-responsive">
                        <table id="students_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Section</th>
                                    @foreach ($room->attendanceCards as $index => $attendance)
                                        <th> {{ $index + 1 }}</th>
                                    @endforeach
                                </tr>
                            </thead>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$('#students_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('attendance.students', $room->id) }}",
    columns: [
        { data: 'name', name: 'name' },
        { data: 'code', name: 'code' },
        { data: 'section', name: 'section' },
        @foreach ($room->attendanceCards as $index => $attendance)
            { data: 'attendance.{{ $index }}', name: 'attendance_{{ $index }}' },
        @endforeach
    ]
});

</script>

@endsection

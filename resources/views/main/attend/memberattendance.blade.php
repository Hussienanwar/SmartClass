@extends('layouts.master')

@section('content')
<div class="container py-5">
    {{-- Display Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Attendance Code Entry Form --}}
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <h4 class="text-center text-primary fw-bold mb-3">🔍 Enter Your Code to Connect</h4>
        <form action="{{ route('attendance.connect', $room->id) }}" method="post">
            @csrf
            <div class="input-group">
                <input type="text" name="code" value="{{$student->code}}" class="form-control rounded-start" placeholder="Enter Your Code" required>
                <button type="submit" class="btn btn-primary rounded-end px-4">
                    <i class="fas fa-sign-in-alt"></i> Connect
                </button>
            </div>
        </form>
    </div>

    {{-- Display Student Attendance Data --}}
    @if(isset($student))
        <div class="card mt-5 shadow-lg border-0 rounded-4 p-4">
            <h5 class="card-title text-center text-success fw-bold mb-3">📋 Your Attendance Record</h5>
            <div class="table-responsive">
                <table class="table table-hover text-center align-middle border">
                    <thead class="table-primary">
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Section</th>
                            @foreach ($room->attendanceCards as $attendance)
                                <th>Session {{ $loop->index + 1 }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">{{ $student->name }}</td>
                            <td class="text-muted">{{ $student->code }}</td>
                            <td>{{ $student->section }}</td>
                            @foreach ($room->attendanceCards as $attendance)
                                @php
                                    $record = $student->attendanceRecords->where('attendance_id', $attendance->id)->first();
                                @endphp
                                <td>
                                    @if ($record && $record->status == 1)
                                        <span class="badge bg-success">✅ Present</span>
                                    @else
                                        <span class="badge bg-danger">❌ Absent</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mb-3">
                {!! $qrCode !!}
            </div>
        </div>
    @endif
</div>
@endsection

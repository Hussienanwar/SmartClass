@extends('layouts.master')
<style>
    body{
        background: #ececec !important;
    }
    .card {
    margin-bottom: 0px !important;
    padding: 30 !important;
}
</style>
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            @include('main.RoomModals.add')
            @include('main.RoomModals.join')
            {{-- Statistic Cards Section --}}
            <div class="row text-center mb-4">
                @if ($userRole === 'admin')
                    {{-- Total Students --}}
                <div class="col-md-4">
                    <a href="{{ route('students.index', ['id' => $room->id]) }}" class="text-decoration-none">
                        <div class="card border-primary shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><i class="fas fa-users"></i> Total Students</h5>
                                <p class="card-text display-6">{{ $room->students->count() }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- Attendance --}}
                <div class="col-md-4 mt-3">
                    <a href="{{ route('attendance.indexAdmin', ['id' => $room->id]) }}" class="text-decoration-none">
                        <div class="card border-danger shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-danger"><i class="fas fa-calendar-check"></i> Attendance Records
                                </h5>
                                <p class="card-text display-6">50</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                {{-- Total Sections --}}
                <div class="col-md-4">
                    <a href="" class="text-decoration-none">
                        <div class="card border-success shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-success"><i class="fas fa-layer-group"></i> Total Sections</h5>
                                <p class="card-text display-6">{{ $room->students->groupBy('section')->count() }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Room --}}
                <div class="col-md-4">
                    <a href="{{ route('rooms.members', ['id' => $room->id]) }}" class="text-decoration-none">
                        <div class="card border-warning shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-warning"><i class="fas fa-qrcode"></i> Room</h5>
                                <p class="card-text display-6">{{ $room->code }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Attendance --}}
                <div class="col-md-4 mt-3">
                    <a href="{{ route('attendance.index', ['id' => $room->id]) }}" class="text-decoration-none">
                        <div class="card border-danger shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-danger"><i class="fas fa-calendar-check"></i> Attendance Records
                                </h5>
                                <p class="card-text display-6">50</p>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Teachers --}}
                <div class="col-md-4 mt-3">
                    <a href="" class="text-decoration-none">
                        <div class="card border-secondary shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-secondary"><i class="fas fa-chalkboard-teacher"></i> Teachers
                                </h5>
                                <p class="card-text display-6">{{ $adminCount}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
        <!-- Include FontAwesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

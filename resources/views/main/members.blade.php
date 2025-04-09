@extends('layouts.master')
<style>
    body {
        background: #ececec !important;
    }
</style>
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            @include('main.RoomModals.add')
            @include('main.RoomModals.join')
            {{-- Statistic Cards Section --}}
            <div class="row justify-content-center text-center mb-2">
                {{-- Total Students --}}
                <div class="col-md-4">
                    <a href="" class="text-decoration-none">
                        <div class="card border-primary shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><i class="fas fa-users"></i> Total Members</h5>
                                <p class="card-text display-6">{{ $room->roomUsers->count() }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Teachers --}}
                <div class="col-md-4 ">
                    <a href="" class="text-decoration-none">
                        <div class="card border-primary shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-secondary"><i class="fas fa-chalkboard-teacher"></i> Teachers
                                </h5>
                                <p class="card-text display-6">{{ $adminCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            {{-- members Table --}}
            <div class="container-fluid mt-4">
                {{-- Room Code Section --}}
                <div class="text-center mb-4">
                    <h4 class="lead">Room Code</h4>
                    {{-- <div>{!! $qrCode !!}</div> --}}
                    <h2 >{{ $room->code }}</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Room Members</h5>
                                <div class="table-responsive">
                                    <table id="students_table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($room->roomUsers as $roomUser)
                                                <tr>
                                                    <td>{{ $roomUser->user->name }}</td>
                                                    <td>{{ $roomUser->user->email }}</td>
                                                    <td>{{ ucfirst($roomUser->role) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Include FontAwesome for Icons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            <!-- Include DataTables -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#students_table').DataTable();
                });
            </script>
        @endsection

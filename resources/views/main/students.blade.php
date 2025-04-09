@extends('layouts.master')
<style>
    body{
        background: #ececec !important;
    }
</style>
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

@if ($errors->has('error_list'))
<div class="alert alert-danger mt-3">
    <h5>Import Errors:</h5>
    <ul>
        @foreach ($errors->get('error_list') as $errorArray)
            @if(is_array($errorArray))
                @foreach ($errorArray as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @else
                <li>{{ $errorArray }}</li>
            @endif
        @endforeach
    </ul>
</div>
@endif
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
                                <h5 class="card-title text-primary"><i class="fas fa-users"></i> Total Students</h5>
                                <p class="card-text display-6">{{ $room->students->count() }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            
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
            </div>
            
    </div>

    {{-- Import Students --}}
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
    <div class="mt-4">
        <h4>Import Students</h4>
        <form action="{{ route('students.import', ['room' => $room->id]) }}" method="POST" enctype="multipart/form-data"
            class="border p-3 rounded bg-light">
            @csrf
            <div class="mb-3">
                <input type="file" name="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Upload</button>
        </form>
    </div>
        </div>
    </div>
    {{-- Students Table --}}
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Students List</h5>
                        <div class="table-responsive">
                            <table id="students_table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($room->students as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->code }}</td>
                                            <td>{{ $student->section }}</td>
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

@extends('layouts.master')
@section('content')
@include('main.RoomModals.join')
    <center class="m-1 p-5">
        <h2>Welcome To Smart Class</h2>
        @include('main.RoomModals.add')
    </center>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container justify-content-center d-flex">
        <div class="card col-6">
            <div class="card-body">
                <div class="py-2">
                    <h3 class="card-title">Doctor details</h3>
                    <div class="row">
                        <ul class="list-group list-group-flush w-100">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Name</h5>
                                {{ $doctor->user->f_name }} {{ $doctor->user->l_name }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Address</h5>
                                {{ $doctor->user->postal_address }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Phone</h5>
                                {{ $doctor->user->phone_num }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Email</h5>
                                {{ $doctor->user->email }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Start date</h5>
                                {{ date('d-m-Y', strtotime($doctor->date_started)) }}
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 ">
                        <h3 class="card-title">Visits</h3>
                        <a href="{{ route('admin.visits.create') }}">Add</a>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <caption>List of doctors visits</caption>
                            <thead>
                                <tr class="bg-success text-white">
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

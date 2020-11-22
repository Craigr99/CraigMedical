@extends('layouts.app')

@section('content')
    <div class="container justify-content-center d-flex">
        <div class="card col-6">
            <div class="card-body">
                <div class="py-2">
                    <h3 class="card-title">Patient details</h3>
                    <div class="row">
                        <ul class="list-group list-group-flush w-100">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Name</h5>
                                {{ $patient->user->f_name }} {{ $patient->user->l_name }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Address</h5>
                                {{ $patient->user->postal_address }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Phone</h5>
                                {{ $patient->user->phone_num }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Email</h5>
                                {{ $patient->user->email }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Policy Number</h5>
                                {{ $patient->policy_num }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Insurance Company</h5>
                                {{ $patient->insurance_name }}
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

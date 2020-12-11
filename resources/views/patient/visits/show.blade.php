@extends('layouts.app')

@section('content')
    <div class="container justify-content-center d-flex">
        <div class="card col-6">
            <div class="card-body">
                <div class="py-2">
                    <h3 class="card-title">Visit details</h3>
                    <div class="row">
                        <ul class="list-group list-group-flush w-100">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Date</h5>
                                {{ date('d-m-Y', strtotime($visit->date)) }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Time</h5>
                                {{ $visit->time }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Duration</h5>
                                {{ $visit->duration }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Doctor</h5>
                                {{ $visit->doctor->user->f_name }} {{ $visit->doctor->user->l_name }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Cost</h5>
                                €{{ $visit->cost }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

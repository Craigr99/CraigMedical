@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h3 class="card-title">Visits</h3>
                    <a href="{{ route('admin.visits.create') }}">Add</a>
                </div>
                @if (count($visits) === 0)
                    <h4>No Visits found!</h4>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <caption>List of visits</caption>
                            <thead>
                                <tr class="bg-success text-white">
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visits as $visit)

                                    <tr>
                                        <td>{{ $visit->date }} </td>
                                        <td>{{ $visit->time }} </td>
                                        <td>{{ $visit->duration }} </td>
                                        <td>{{ $visit->patient_id }} </td>
                                        <td>{{ $visit->doctor_id }} </td>
                                        <td>€{{ $visit->cost }} </td>
                                        <td>Actions</td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

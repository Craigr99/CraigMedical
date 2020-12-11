@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h3 class="card-title">Your Visits</h3>
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
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visits as $visit)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($visit->date)) }} </td>
                                        <td>{{ $visit->time }} </td>
                                        <td>{{ $visit->duration }} </td>
                                        <td>{{ $visit->doctor->user->f_name }} {{ $visit->doctor->user->l_name }} </td>
                                        <td>€{{ $visit->cost }} </td>
                                        <td class="d-flex justify-content-lg-between">
                                            <a href="{{ route('patient.visits.show', $visit->id) }}">View</a>
                                            <form method="POST" action="{{ route('patient.visits.destroy', $visit->id) }}">
                                                <input type="hidden" value="DELETE" name="_method">
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                <input class="input-delete" type="submit" value="Cancel">
                                            </form>
                                        </td>
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

@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h3 class="card-title">Your Visits</h3>
                    <a href="{{ route('doctor.visits.create') }}">Add</a>
                </div>
                @if (count($visits) === 0)
                    <h4>No Visits found!</h4>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <caption>List of visits</caption>
                            <thead>
                                <tr class="bg-success text-white">
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visits as $visit)

                                    <tr class="{{ $visit->status == 'Cancelled' ? 'table-danger' : '' }}">
                                        <td>{{ $visit->status }}</td>
                                        <td>{{ date('d-m-Y', strtotime($visit->date)) }} </td>
                                        <td>{{ $visit->time }} </td>
                                        <td>{{ $visit->duration }} </td>
                                        <td>{{ $visit->patient->user->f_name }} {{ $visit->patient->user->l_name }} </td>
                                        <td>€{{ $visit->cost }} </td>
                                        <td class="d-flex justify-content-lg-between">
                                            <a href="{{ route('doctor.visits.show', $visit->id) }}">View</a>
                                            <a href="{{ route('doctor.visits.edit', $visit->id) }}">Edit</a>
                                            <form method="POST" action="{{ route('doctor.visits.destroy', $visit->id) }}">
                                                <input type="hidden" value="DELETE" name="_method">
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                <input class="input-delete" type="submit" value="Delete">
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $visits->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

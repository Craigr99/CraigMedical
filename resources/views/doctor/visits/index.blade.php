@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
        {{-- Delete modal --}}
        <div class="clearfix"></div>
        <div class="modal fade" id="delete-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Visit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this visit?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

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
                                            <a href="#" class="input-delete" data-toggle="modal"
                                                data-target="#delete-modal">Delete</a>
                                            <form method="POST" id="delete-form"
                                                action="{{ route('doctor.visits.destroy', $visit->id) }}">
                                                @csrf
                                                @method('DELETE')
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

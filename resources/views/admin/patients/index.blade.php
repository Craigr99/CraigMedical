@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
        {{-- Delete modal --}}
        <div class="clearfix"></div>
        <div class="modal fade" id="delete-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this patient?</p>
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
                    <h3 class="card-title">Patients</h3>
                    <a href="{{ route('admin.patients.create') }}">Add</a>
                </div>
                @if (count($patients) === 0)
                    <h4>No patients found!</h4>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <caption>List of patients</caption>
                            <thead>
                                <tr class="bg-success text-white">
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Insurance</th>
                                    <th scope="col">Policy Number</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->user->f_name }} {{ $patient->user->l_name }}</td>
                                        <td>
                                            {{ Str::limit($patient->user->postal_address, 15) }}
                                        </td>
                                        <td>{{ $patient->user->phone_num }}</td>
                                        <td>{{ $patient->user->email }}</td>
                                        @if ($patient->insurance_id === null)
                                            <td></td>
                                        @else
                                            <td>{{ $patient->insuranceCompany->name }} </td>
                                        @endif
                                        <td>{{ $patient->policy_num }}</td>
                                        <td class="d-flex justify-content-lg-between">
                                            <a href="{{ route('admin.patients.show', $patient->id) }}">View</a>
                                            <a href="{{ route('admin.patients.edit', $patient->id) }}">Edit</a>
                                            <a href="#" class="input-delete" data-toggle="modal"
                                                data-target="#delete-modal">Delete</a>
                                            <form method="POST" id="delete-form"
                                                action="{{ route('admin.patients.destroy', $patient->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $patients->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
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
                                    {{-- <th scope="col">Health insurance</th>
                                    --}}
                                    <th scope="col">Insurance Name</th>
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
                                        <td>{{ $patient->insurance_name }}</td>
                                        <td>{{ $patient->policy_num }}</td>
                                        <td class="d-flex justify-content-lg-between">
                                            <a href="{{ route('admin.patients.show', $patient->id) }}">View</a>
                                            <a href="{{ route('admin.patients.edit', $patient->id) }}">Edit</a>
                                            <form method="POST"
                                                action="{{ route('admin.patients.destroy', $patient->id) }}">
                                                <input type="hidden" value="DELETE" name="_method">
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                <input class="input-delete" type="submit" value="Delete">
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

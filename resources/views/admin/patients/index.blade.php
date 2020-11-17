@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h3 class="card-title">Patients</h3>
                    <a href="{{ route('admin.patients.create') }}">Add</a>
                </div>
                @if (count($users) === 0)
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
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->f_name }} {{ $user->l_name }}</td>
                                        <td>{{ Str::limit($user->postal_address, 15) }}</td>
                                        <td>{{ $user->phone_num }}</td>
                                        <td>{{ $user->email }}</td>
                                        {{-- @if ($user->patient->insurance == 1)
                                            <td>Yes</td>
                                            @else
                                            <td>No</td>
                                        @endif --}}
                                        <td>{{ $user->patient->insurance_name }}</td>
                                        <td>{{ $user->patient->policy_num }}</td>
                                        <td class="d-flex justify-content-lg-between">
                                            <a href="{{ route('admin.doctors.show', $user->id) }}">View</a>
                                            <a href="#">Edit</a>
                                            <form method="POST" action="{{ route('admin.doctors.destroy', $user->id) }}">
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

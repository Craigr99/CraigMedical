@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Doctors</h3>
                    <a href="{{ route('doctors.create') }}">Add</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <caption>List of doctors</caption>
                        <thead>
                            <tr class="bg-success text-white">
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Start date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctor->f_name }} {{ $doctor->l_name }}</td>
                                    <td>{{ $doctor->postal_address }}</td>
                                    <td>{{ $doctor->phone_num }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->start_date }}</td>
                                    <td class="d-flex justify-content-lg-between">
                                        <a href="#">View</a>
                                        <a href="#">Edit</a>
                                        <a href="#">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <h4 class="text-center">No Doctors Found!</h4>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

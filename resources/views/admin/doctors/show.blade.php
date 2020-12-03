@extends('layouts.app')

@section('content')
    <div class="container justify-content-center d-flex">
        <div class="card col-12 col-md-10 col-xl-6">
            <div class="card-body">
                <div class="py-2">
                    <h3 class="card-title">Doctor details</h3>
                    <div class="row">
                        <ul class="list-group list-group-flush w-100">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Name</h5>
                                {{ $doctor->user->f_name }} {{ $doctor->user->l_name }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Address</h5>
                                {{ $doctor->user->postal_address }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Phone</h5>
                                {{ $doctor->user->phone_num }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Email</h5>
                                {{ $doctor->user->email }}
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h5 class="">Start date</h5>
                                {{ date('d-m-Y', strtotime($doctor->date_started)) }}
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 ">
                        <h3 class="card-title">Visits</h3>
                        <a href="{{ route('admin.visits.create', $doctor->id) }}">Add</a>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <caption>List of doctors visits</caption>
                            <thead>
                                <tr class="bg-success text-white">
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doctor->visit as $visit)
                                    <tr>
                                        {{-- Dynamic row numbers --}}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d-m-Y', strtotime($visit->date)) }} </td>
                                        <td>{{ $visit->time }} </td>
                                        <td>{{ $visit->duration }} </td>
                                        <td>{{ $visit->patient->user->f_name }}
                                            {{ $visit->patient->user->l_name }}
                                        </td>
                                        <td class="d-flex justify-content-lg-between">
                                            <a href="{{ route('admin.visits.show', $visit->id) }}">View</a>
                                            <a href="{{ route('admin.visits.edit', $visit->id) }}">Edit</a>
                                            <form method="POST" action="{{ route('admin.visits.destroy', $visit->id) }}">
                                                <input type="hidden" value="DELETE" name="_method">
                                                @csrf
                                                <input class="input-delete" type="submit" value="Delete">
                                            </form>
                                        </td>
                                    @empty
                                        <td>None found,</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

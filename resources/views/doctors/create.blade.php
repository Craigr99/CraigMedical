@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Create Doctor</h3>

                <form action="{{ route('doctors.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="f_name">First name</label>
                            <input name="f_name" type="text" class="form-control" id="f_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="l_name">Surname</label>
                            <input name="l_name" type="text" class="form-control" id="l_name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="address">Address</label>
                            <input name="address" type="text" class="form-control" id="address">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone</label>
                            <input name="phone" type="text" class="form-control" id="phone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label for="start_date">Start date</label>
                            <input name="start_date" type="date" class="form-control" id="start_date">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Doctor Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3>Welcome back {{ Auth::user()->f_name }} {{ Auth::user()->l_name }}</h3>
                        You are logged in as a Doctor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

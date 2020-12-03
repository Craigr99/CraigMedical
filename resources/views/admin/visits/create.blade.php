@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Create Visit</h3>

                <form action="{{ route('admin.visits.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date">Date</label>
                            <input name="date" type="date"
                                class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }} {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                id="date" value="{{ old('date') }}">
                            @if ($errors->has('date'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="time">Time </label>
                            <input name="time" type="time"
                                class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" id="time"
                                value="{{ old('time') }}">
                            @if ($errors->has('time'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('time') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="duration">Duration</label>
                            <input name="duration" type="text"
                                class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" id="duration"
                                value="{{ old('duration') }}" placeholder="Mins">
                            @if ($errors->has('duration'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('duration') }}
                                </span>
                            @endif
                        </div>
                        <div class="col mb-3">
                            <label for="cost">Cost</label>
                            <input name="cost" type="text"
                                class="form-control {{ $errors->has('cost') ? 'is-invalid' : '' }}" id="cost"
                                value="{{ old('cost') }}" placeholder="€">
                            @if ($errors->has('cost'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('cost') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label for="doctor">Doctor</label>
                            <select name="doctor_id" class="form-control" id="doctor_id">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ $id == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->user->f_name }}
                                        {{ $doctor->user->l_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('doctor'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="patient">Patient</label>
                            <select name="patient_id" class="form-control" id="patient_id">
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->user->f_name }}
                                        {{ $patient->user->l_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('patient'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('patient') }}
                                </span>
                            @endif
                        </div>
                    </div>


                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection

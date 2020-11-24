@extends('layouts.app')

@section('content')
    <div class="container mt-md-5">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Create Patient</h3>

                <form action="{{ route('admin.patients.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="f_name">First name</label>
                            <input name="f_name" type="text"
                                class="form-control {{ $errors->has('f_name') ? 'is-invalid' : '' }} {{ $errors->has('f_name') ? 'is-invalid' : '' }}"
                                id="f_name" value="{{ old('f_name') }}">
                            @if ($errors->has('f_name'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('f_name') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="l_name">Surname</label>
                            <input name="l_name" type="text"
                                class="form-control {{ $errors->has('l_name') ? 'is-invalid' : '' }}" id="l_name"
                                value="{{ old('l_name') }}">
                            @if ($errors->has('l_name'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('l_name') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="address">Address</label>
                            <input name="address" type="text"
                                class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address"
                                value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone</label>
                            <input name="phone" type="text"
                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone"
                                value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input name="email" type="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                                value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="{{ $errors->has('insurance') ? 'is-invalid' : '' }}">Has Health Insurance</label>
                            <div class="form-check">
                                <input name="insurance"
                                    class="form-check-input {{ $errors->has('insurance') ? 'is-invalid' : '' }}"
                                    type="radio" value="yes" {{ old('insurance') == 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="insurance"
                                    class="form-check-input {{ $errors->has('insurance') ? 'is-invalid' : '' }}"
                                    type="radio" value="no" {{ old('insurance') == 'no' ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    No
                                </label>
                            </div>
                            @if ($errors->has('insurance'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('insurance') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="insurance_id">Insurance Name</label>
                            <select name="insurance_id"
                                class="form-control {{ $errors->has('insurance_id') ? 'is-invalid' : '' }}"
                                id="insurance_id">
                                @foreach ($insurance_companies as $insurance)
                                    <option value="{{ $insurance->id }}"
                                        {{ old('insurance_id') == $insurance->id ? 'selected' : '' }}>{{ $insurance->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('insurance_id'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('insurance_id') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="policy_num">Policy Number</label>
                            <input name="policy_num" type="text"
                                class="form-control {{ $errors->has('policy_num') ? 'is-invalid' : '' }}" id="policy_num"
                                value="{{ old('policy_num') }}">
                            @if ($errors->has('policy_num'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('policy_num') }}
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

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('code') }}" aria-label="{{ __('Login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="LoginCode"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Confirmation Code:') }}</label>

                                <div class="col-md-6">
                                    <input id="LoginCode" type="text"
                                           class="form-control"
                                           name="LoginCode" value="{{ old('confirmation') }}" required autofocus>


                                </div>
                            </div>





                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="confirmation_form">
                                        {{ __('Confirm Account') }}
                                    </button>




                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

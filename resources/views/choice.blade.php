@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login/choice') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="entry"
                                       class="col-sm-4 col-form-label text-md-right"
                                       id="info">{{ __('Your Phone Number' ) }}</label>

                                <div class="col-md-6">
                                   <!-- <input id="entry" type="text"
                                           class="form-control"
                                           name="entry" value="{{ old('email') }}" required autofocus>-->
                                       <input id="entry"  class="form-control"  name="entry"  type="text"><br>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <div class="row">

                                        <div class="col-md-2"><input type="radio" name="result"
                                                                     value="SMS" id="r2"
                                                                     onclick="makeBold();"><span
                                                    id="span_SMS">SMS</span></div>
                                        <div class="col-md-2"><input type="radio" name="result" value="Mail" id='r1'
                                                                     onclick="makeBold();"><span
                                                    id="span_Mail">Mail</span></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary" name="radio">
                                                {{ __('Send') }}
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">

                                    <a href="{{url('/login')}}" class="btn btn-link" style="margin-left: 50%;"> Login
                                        with password instead </a></div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section("status")
    @if(Session::has('status'))
        <div class="alert alert-info ">
            {{ Session::get('status') }}
        </div>
    @endif

@endsection




@section("mailStatus")
    @if(Session::has('mailStatus'))
        <div class="alert alert-info ">
            {{ Session::get('mailStatus') }}
        </div>
    @endif
@endsection



<script type="text/javascript">


    function makeBold() {
        var radios = document.getElementsByName("result");

        for (var index = 0; index < radios.length; index++) {
            if (radios[index].checked) {
                document.getElementById("span_" + radios[index].value).style.color = '#0b00f2';
                if (radios[index].value == 'SMS') {
                    document.getElementById("info").innerHTML = "Your Phone Number";
                    document.getElementById("entry").name="phone"
                }
                else {

                    document.getElementById("info").innerHTML = "E-Mail Address";
                    document.getElementById("entry").name="email"

                }
            }
            else {
                document.getElementById("span_" + radios[index].value).style.color = 'black';
            }
        }

    }
</script>
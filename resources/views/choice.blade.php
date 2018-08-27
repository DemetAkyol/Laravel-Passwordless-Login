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


                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-2"><input type="radio" name="result" value="Mail" id='r1'
                                                                     onclick="makeBold();"{{ !(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])) ? "checked" : " "}} ><span
                                                    id="span_Mail">Mail</span></div>

                                        <div class="col-md-2"><input type="radio" name="result"
                                                                     value="SMS" id="r2"
                                                                     onclick="makeBold();" {{ (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])) ? "checked" : " "}}><span
                                                    id="span_SMS">SMS</span></div>
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

                                    <a href="{{url('/login')}}" class="btn btn-link" style="margin-left: 50%;">Login
                                        with password instead </a></div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">


    function makeBold() {
        var radios = document.getElementsByName("result");
        for (var index = 0; index < radios.length; index++) {
            if (radios[index].checked) {
                document.getElementById("span_" + radios[index].value).style.color = '#0962f2';
            }
            else {
                document.getElementById("span_" + radios[index].value).style.color = 'black';
            }
        }
    }
</script>
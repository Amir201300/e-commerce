    <div class="col-md-9 col-sm-12">
        <div class="row">
            <div class="center-content buy">    
                <div class="col-md-8 col-md-offset-2">
                    <div class="box">
                        <h3 class="title">{{__('site.Login')}}</h3>
                        <form method="POST" action="{{ route('login') }}" class="forms login-form">
                                @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="email" class="form-control" placeholder="user name / e-mail">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div><!--col-md-6-->
                                <div class="col-md-12">
                                    <input type="password" name="password" class="form-control" placeholder="password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div><!--col-md-6-->
                                <div class="col-md-6 remem" >
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </div><!--col-md-6-->
                                <div class="col-md-6">
                                    <a href="{{ route('password.request') }}" class="forget">forget your password ?</a>
                                </div><!--col-md-6-->
   
                                <div class="col-md-12 text-center" >
                                    <button type="submit" class="login">login</button>
                                </div><!--col-md-12-->
                            </div><!--row-->
                        </form>
                    </div><!--box-->
                </div><!--center-content-->
            </div><!--col-md-12-->          
        </div><!--row-->
   
    </div><!--col-md-6-->

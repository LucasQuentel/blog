@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<h1>User Settings</h1>
        	<hr>
        	<div class="row">
				<div class="col-lg-5">
					<center><h3>Change password</h3></center>
							@if(isset($errorpw))
								<div class="alert alert-danger">{{ $errorpw }}</div>
							@elseif(isset($confirmpw))
								<div class="alert alert-success">{{ $confirmpw }}</div>
							@endif	
						<form action="/settings/update/password" method="POST" class="form-horizontal" role="form">				

							<div class="form-group{{ $errors->has('oldpw') ? ' has-error' : '' }}">
                            	<label class="col-md-4 control-label">Old Password</label>

                            	<div class="col-md-6">
                                	<input type="password" class="form-control" name="oldpw">

                                	@if ($errors->has('oldpw'))
                                    	<span class="help-block">
                                        	<strong>{{ $errors->first('oldpw') }}</strong>
                                    	</span>
                                	@endif
                            	</div>
                        	</div>	
 							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            	<label class="col-md-4 control-label">New Password</label>

                            	<div class="col-md-6">
                                	<input type="password" class="form-control" name="password">

                                	@if ($errors->has('password'))
                                    	<span class="help-block">
                                        	<strong>{{ $errors->first('password') }}</strong>
                                    	</span>
                                	@endif
                            	</div>
                        	</div>		
                        	<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            	<label class="col-md-4 control-label">Confirm Password</label>

                            	<div class="col-md-6">
                                	<input type="password" class="form-control" name="password_confirmation">

                                	@if ($errors->has('password_confirmation'))
                                    	<span class="help-block">
                                        	<strong>{{ $errors->first('password_confirmation') }}</strong>
                                    	</span>
                                	@endif
                            	</div>
                        	</div>												
            					<input type="hidden" name="_token" value="{{ csrf_token() }}">						
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<input type="submit" class="btn btn-primary" value="Change" />
									</div>
								</div>
						</form>
				</div>
				<div class="col-lg-2"></div>
				<div class="col-lg-5">
					<center><h3>Change E-Mail</h3></center>
							@if(isset($errorem))
								<div class="alert alert-danger">{{ $errorem }}</div>
							@elseif(isset($confirmem))
								<div class="alert alert-success">{{ $confirmem }}</div>
							@endif						
					<form action="/settings/update/email" method="POST" class="form-horizontal" role="form">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Old E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>		
                        <div class="form-group{{ $errors->has('newemail') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">New E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="newemail" value="{{ old('newemail') }}">

                                @if ($errors->has('newemail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newemail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('newemail_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Repeat E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="newemail_confirmation" value="{{ old('newemail_confirmation') }}">

                                @if ($errors->has('newemail_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newemail_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>						
            					<input type="hidden" name="_token" value="{{ csrf_token() }}">						
							
					
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<button type="submit" class="btn btn-primary">Change</button>
								</div>
							</div>
					</form>
				</div>
        	</div>
        </div>
    </div>
</div>
@endsection
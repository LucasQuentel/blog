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
						<form action="/settings/update/password" method="POST" class="form-horizontal" role="form">						<div class="form-group">
									<label for="oldpw">Old Password</label>
									<input type="password" name="oldpw" id="input" class="form-control" required="required" title="oldpw" placeholder="Old Password">
								</div>		
								<div class="form-group">
									<label for="password">New Password</label>
									<input type="password" name="password" id="input" class="form-control" required="required" title="password" placeholder="New Password">
								</div>	
								<div class="form-group">
									<label for="oldpw">Repeat New Password</label>
									<input type="password" name="password_confirmation" id="input" class="form-control" required="required" title="password_confirmation" placeholder="Repeat New Password">
								</div>							
            					<input type="hidden" name="_token" value="{{ csrf_token() }}">						
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<button type="submit" class="btn btn-primary">Change</button>
									</div>
								</div>
						</form>
				</div>
				<div class="col-lg-2"></div>
				<div class="col-lg-5">
					<center><h3>Change E-Mail</h3></center>
					<form action="/settings/update/email" method="POST" class="form-horizontal" role="form">
								<div class="form-group">
									<label for="oldemail">Old E-Mail</label>
									<input type="email" name="oldem" id="input" class="form-control" required="required" title="oldem" placeholder="Old E-Mail">
								</div>		
								<div class="form-group">
									<label for="email">New E-Mail</label>
									<input type="email" name="email" id="input" class="form-control" required="required" title="email" placeholder="New E-Mail">
								</div>	
								<div class="form-group">
									<label for="oldpw">Repeat New E-Mail</label>
									<input type="email" name="email_confirmation" id="input" class="form-control" required="required" title="email_confirmation" placeholder="Repeat New E-Mail">
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
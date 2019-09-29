	
<!-- Login -->

<div class="row vcenter">
	<div class="col-xs-12 col-sm-12 col-md-6 col-md-push-3">
		<h1 style="font-size: 2em; padding-bottom: 0.5em;">Ingreso</h1>

		<form action="#" onsubmit="return false;">

			<div class="form-group" >

				<div class="input-group" style="margin-bottom:1em;">
					<span class="input-group-addon">
					<i class="glyphicon glyphicon-user"></i>
					</span>
					<select class="form-control" id="role">
						<!-- hardcoded      -->
						<option value="1" selected>Default</option>
						<option value="2">Regular</option>
						<option value="100">Admin</option>
					</select>
				</div>

				<div class="input-group" style="margin-bottom:1em;">
					<span class="input-group-addon">
					<i class="glyphicon glyphicon-envelope"></i>
					</span>
					<input type="email" class="form-control" id="email" placeholder="email" required="required">
				</div>

				<div class="input-group" style="margin-bottom:1em;">
					<span class="input-group-addon">
					<i class="glyphicon glyphicon-lock"></i>
					</span>
					<input type="password" class="form-control" id="password" placeholder="Password" required="required">
				</div>
				
				<div style="color:red; text-align: center;" id="loginError"></div>
			
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-lg btn-block login-btn" onClick="login()">Login</button>
			</div>

			No registrado? <a href="/login/signup">regístrese</a>
		</form>		
		
	</div>
</div>

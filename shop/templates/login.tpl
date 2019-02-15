
<section class="u-h-50vh u-flex-center">
  <div class="container">
    <div class="row">
    	<div class="col-lg-5 m-auto text-center">
			 <div class="card box-shadow-v2 bg-white u-of-hidden">
			 	<h2 class="bg-primary m-0 py-3 text-white">Login</h2>
			 		<div class="p-4 p-md-5">
			 			
					<form method="POST">

						<div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
							<div class="input-group-addon bg-white border-0 pl-4 pr-0">
								<span class="icon icon-User text-primary"></span>
							</div>
							<input type="text" class="form-control border-0 p-3" placeholder="Your login" name="login">
						</div>

						<div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
							<div class="input-group-addon bg-white border-0 pl-4 pr-0">
								<span class="icon icon-Mail text-primary"></span>
							</div>
							<input type="text" class="form-control border-0 p-3" placeholder="Your password" name="password">
						</div>
							<div class="d-flex justify-content-between align-items-center">
								<label class="custom-control custom-checkbox text-left">
									<input type="checkbox" class="custom-control-input" name="rememberme">
									<span class="custom-control-indicator mt-1"></span>
									<span class="custom-control-description">Запомнить</span>
								</label>
								<a href="login.html">Forgot password?</a>
							</div>
							<button type="submit" class="btn btn-primary btn-rounded u-mt-20 u-w-170">
								Войти
							</button>
					</form>
					<p class="text-red">{{AUTHERROR}}</p>
			 		</div> <!-- END p-4 p-md-5-->
			 </div>  <!-- END card-->
     </div> <!-- END col-lg-5-->
    </div> <!-- END row-->
  </div> <!-- END container-->
</section>

<style>
html, body{
	height: 100%;
	margin: 0;
}
</style>
<div class="h-100 container-fluid">
	<div class="h-100 row justify-content-md-center">
  	<div class="h-100 col-md-8 text-white p-5" style="background: #212121;">
        <h1>Kaca <small>Beta Version</small></h1>
		<p class="lead text-muted">Efficiency & Simplicity</p>
		<div class="row mt-3">
			<div class="col-md-3 my-2"><button type="button" class="btn btn-outline-secondary btn-block"><span class="fa fa-comments mr-2"></span>Confide</button></div>
			<div class="col-md-3 my-2"><button type="button" class="btn btn-outline-secondary btn-block"><span class="fa fa-video-camera mr-2"></span>Video</button></div>
			<div class="col-md-3 my-2"><button type="button" class="btn btn-outline-secondary btn-block"><span class="fa fa-shopping-bag mr-2"></span>Shop</button></div>
			<div class="col-md-3 my-2"><button type="button" class="btn btn-outline-secondary btn-block"><span class="fa fa-music mr-2"></span>Music</button></div>
		</div>
	</div>
  	<div class="h-100 col-md-4 bg-white p-5">
			<h1>Daftar</h1>
			<?= form_open('register'); ?>
				<div class="form-group text-dark">
			    	<label for="exampleInputEmail1">Username</label>
			    	<input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username"  autocorrect="off" autocapitalize="none">
					<?= form_error('username'); ?>
			  	</div>
			  	<div class="form-group text-dark">
			    	<label for="exampleInputEmail1">Nama Lengkap</label>
			    	<input type="text" name="full_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Full name">
					<?= form_error('full_name'); ?>
				</div>
				<div class="form-group text-dark">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					<?= form_error('email'); ?>
				</div>
			  	<div class="form-group text-dark">
			    	<label for="exampleInputPassword1">Password</label>
			    	<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					<?= form_error('password'); ?>
			  	</div>
			  	<div class="form-group text-dark">
			    	<label for="exampleInputPassword1">Ulangi Password</label>
			    	<input type="password" name="password2" class="form-control" id="exampleInputPassword1" placeholder="Konfirm Password">
					<?= form_error('password2'); ?>
			  	</div>
			  	<button type="submit" class="btn btn-dark">Submit</button>
			  	<a href="login" class="btn btn-link text-dark">Sudah punya akun</a>
			<?= form_close(); ?>
		</div>
</div>
</div>

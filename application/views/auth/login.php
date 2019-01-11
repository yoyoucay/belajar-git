<style>
html, body{
	height: 100%;
	margin: 0;
}
</style>
<div class="h-100 container-fluid">
	<div class="h-100 row">
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
			<h1>Masuk</h1>
			<?= form_open('login'); ?>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			    <!--<small id="emailHelp" class="form-text">Kami tidak akan pernah membagikan email Anda dengan orang lain.</small>-->
			    <?= form_error('email'); ?>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			    <?= form_error('password'); ?>
			  </div>
			  <button type="submit" class="btn btn-dark">Submit</button>
			  <a href="register" class="btn btn-link text-dark">Belum punya akun</a>
			<?= form_close(); ?>
		</div>
</div>
</div>
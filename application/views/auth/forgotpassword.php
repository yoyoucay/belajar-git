<div class="h-100 col-md-4 bg-white p-5">
		<h1>Lupa Password</h1>
			<?= form_open('auth/forgot_password'); ?>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			    <!--<small id="emailHelp" class="form-text">Kami tidak akan pernah membagikan email Anda dengan orang lain.</small>-->
			    <?= form_error('email'); ?>
			  <button type="submit" class="btn btn-dark">Submit</button>
			<?= form_close(); ?>
</div>
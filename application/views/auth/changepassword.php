            <?= form_open('auth/verify_forgot/'.$email.'/'.$token); ?>
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
			<?= form_close(); ?>
<div class="container text-center">
    <div class="row">
        <div class="col-12">
            <div class="jumbotron">
                <h1 class="display-4">Aktivasi Email</h1>
                <p class="lead">Email Aktivasi Sudah dikirim ke email anda !</p>
                <hr class="my-4">
                <p>Email belum dikirim? klik</p>
                <?= form_open('auth/activationUser');?>
                <input type="hidden" id="custId" name="email" value="<?php echo $email; ?>">
                <input type="hidden" id="custId" name="token" value="<?php echo $token; ?>">
                <button type="submit" class="btn btn-primary btn-lg">Kirim Ulang</button>
                <?= form_close(); ?>  
            </div>
        </div>
    </div>
</div>
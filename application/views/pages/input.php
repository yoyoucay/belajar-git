<div class="container-fluid my-5 py-3">
    <h2>
        <b><a onclick="goBack()" class="text-dark btn btn-transparent fa fa-arrow-left"></a>Input</b>
    </h2>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Teks</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Gambar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Video</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <?php echo form_open('confide/tambah_confide'); ?>
          <div class="form-group mt-2">
            <input type="hidden" name="user_id" id="" value="<?php echo $_SESSION['user_id']; ?>">
            <textarea class="form-control" name="input_deskripsi" id="exampleFormControlTextarea1" rows="3" style="max-height: 150px;min-height: 150px;" placeholder="Tulis curhatmu disini.."></textarea>
            <input type="submit" name="submit" class="btn btn-primary my-3 btn-block" value="Bagikan">
          </div>
        <?php echo form_close(); ?>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <!-- Upload Gambar -->
      <div style="color: red;"><?php echo (isset($message))? $message : ""; ?></div>
        <?php echo form_open("confide/tambah_confidePhoto", array('enctype'=>'multipart/form-data')); ?>
          <div class="form-group  mt-2">
          
            <input type="file" class="form-control-file" name="input_gambar" id="exampleFormControlFile1">
          </div>
          <div class="form-group mt-2">
          <input type="hidden" name="user_id" id="" value="<?php echo $_SESSION['user_id']; ?>">
            <textarea class="form-control" name="input_deskripsi" id="exampleFormControlTextarea1" rows="3" style="max-height: 150px;min-height: 150px;" placeholder="Tulis caption fotomu disini.."></textarea>
          </div>
          <input type="submit" name="submit" class="btn btn-primary my-3 btn-block" value="Bagikan">
        <?php echo form_close(); ?>
      </div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <?php echo form_open("confide/tambah_confideVideo", array('enctype'=>'multipart/form-data')); ?>
          <div class="form-group mt-2">
          <input type="hidden" name="user_id" id="" value="<?php echo $_SESSION['user_id']; ?>">
            <label for="formGroupExampleInput">Judul video</label>
            <input type="text" name="judul" class="form-control" id="formGroupExampleInput" placeholder="Tulis judul videomu disini..">
          </div>
          <div class="form-group">
            <input type="file" name="input_video" class="form-control-file" id="exampleFormControlFile1">
          </div>
          <div class="form-group mt-2">
            <textarea class="form-control" name="input_deskripsi" id="exampleFormControlTextarea1" rows="3" style="max-height: 150px;min-height: 150px;" placeholder="Tulis caption videomu disini.."></textarea>
          </div>
          <button type="submit" class="btn btn-primary my-3 btn-block">Bagikan</button>
        <?php echo form_close(); ?>
      </div>
    </div>

</div>
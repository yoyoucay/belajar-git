<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><span class="fa fa-file-video-o mr-2"></span>Unggah video</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <?php echo form_open('confide/update_confideVideo/'.$content['username'].'/'.$content['id']); ?>
      <div class="form-group mt-2">
        <input type="hidden" name="user_id" id="" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="text" name="judul" id="" value="<?php echo $content['judul']; ?>">
        <textarea class="form-control" name="input_deskripsi" id="exampleFormControlTextarea1" rows="3" style="max-height: 150px;min-height: 150px;"><?php echo $content['deskripsi']; ?></textarea>
        <input type="submit" name="submit" class="btn btn-primary my-3 btn-block" value="Simpan">
      </div>
    <?php echo form_close(); ?>
  </div>
</div>
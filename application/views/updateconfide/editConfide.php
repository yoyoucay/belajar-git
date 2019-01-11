<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><span class="fa fa-file-word-o mr-2"></span>Tulis curhat</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <?php echo form_open('confide/update_confide/'.$content['username'].'/'.$content['id']); ?>
      <div class="form-group mt-2">
        <input type="hidden" name="user_id" id="" value="<?php echo $_SESSION['user_id']; ?>">
        <textarea class="form-control" name="input_deskripsi" id="exampleFormControlTextarea1" rows="3" style="max-height: 150px;min-height: 150px;"><?php echo $content['deskripsi']; ?></textarea>
        <input type="submit" name="submit" class="btn btn-primary my-3 btn-block" value="Simpan">
      </div>
    <?php echo form_close(); ?>
  </div>
</div>
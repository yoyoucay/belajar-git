<div class="container-fluid my-5 py-4">
    <div class="media">
        <img class="rounded mr-3 mb-3" src="
                <?php if($user_item['nama_avatar'] == true){ ?>
                <?php echo "http://kaca-beta.com/images/avatar/".$user_item['nama_avatar']; ?>
                <?php }else{ ?>
                <?php echo base_url("assets/img/user.png");} ?>
        " alt="Generic placeholder image" width="80" height="80">
        <div class="media-body">
            <h6>@<?php echo $user_item['username']; ?></h6>
            <!-- Follow -->
            <?php if(@$_SESSION['user_id'] == TRUE){ ?>
                <?php if(@$_SESSION['user_id'] == $user_item['id']){?>
                    <button class="btn btn-primary btn-sm btn-block"> Edit Profile</button>
                <?php }else if(@$_SESSION['user_id'] != $user_item['id']){ ?>
                    <?php if($follow == FALSE){ ?>
                        <?php echo form_open('auth/follow'); ?>
                        <input type="hidden" name="aku" value="<?php echo @$_SESSION['user_id']; ?>">
                        <input type="hidden" name="dia" value="<?php echo $user_item['id']; ?>">
                        <input type="submit" class="btn btn-primary btn-sm btn-block" value="Follow">
                        <?php echo form_close(); ?>
                    <?php }else{  ?>
                        <?php echo form_open('auth/unfollow'); ?>
                        <input type="hidden" name="aku" value="<?php echo @$_SESSION['user_id']; ?>">
                        <input type="hidden" name="dia" value="<?php echo $user_item['id']; ?>">
                        <input type="submit" class="btn btn-primary btn-sm btn-block" value="Unfollow">
                        <?php echo form_close(); ?>
                    <?php }?>
                <?php } ?>
            <?php } ?>
            <!-- End Follow -->
        </div>
    </div>
    <h6 class="text-capitalize"><?php echo $user_item['full_name']; ?></h6>
    <span><?php echo $user_item['biodata'];?></span>
    <hr>
    <div class="row">
        <div class="col text-center"><b class="h5"><?php echo $kiriman['kiriman']; ?></b><br><small>Kiriman</small></div>
        <div class="col text-center" data-toggle="modal" data-target="#exampleModal2" style="cursor: pointer"><b class="h5"><?php echo $count_follower['pengikut']; ?></b><br><small>Pengikut</small></div>
        <div class="col text-center" data-toggle="modal" data-target="#exampleModal" style="cursor: pointer"><b  class="h5"><?php echo $count_follow['mengikuti']; ?></b><br><small>Diikuti</small></div>
    </div>
    <ul class="list-group list-group-flush mt-3">
        <?php foreach ($confide as $confide_item) { ?>

        <li class="list-group-item">
            <div class="media">
                <!-- Start Photo -->
                <img class="mr-3 rounded" src="
                <?php if($confide_item['nama_avatar'] == true){ ?>
                <?php echo "http://kaca-beta.com/images/avatar/".$confide_item['nama_avatar']; ?>
                <?php }else{ ?>
                <?php echo base_url("assets/img/user.png");} ?>
                " alt="Generic placeholder image" style="max-width:50px;max-height:50px;min-height: 50px;">
                <!-- End Photo -->
                <div class="media-body">
                    <h6 class="mt-0 text-capitalize"><?php echo $confide_item['full_name']; ?></h6>
                    <h6 class="small text-secondary"><?php echo date("j F Y", strtotime($confide_item['created_at'])); ?></h6>
                </div>
            </div>
            <?php if(
                    $confide_item['tipe_file'] == 'image/png' ||
                    $confide_item['tipe_file'] == 'image/jpeg'
                    ){ ?>
            <img class="img-fluid rounded mt-2" src="<?php echo "http://kaca-beta.com/images/".$confide_item['nama_file']; ?>" alt="img">
            <?php }else if($confide_item['tipe_file'] == 'video/mp4'){?>
            <video class="mt-3 rounded" width="595" controls>
                <source src="<?php echo "http://kaca-beta.com/videos/".$confide_item['nama_file']; ?>" type="<?php echo $confide_item['tipe_file']; ?>">
            </video>
            <h5><?php echo $confide_item['judul']; ?></h5>
            <?php }else{} ?>
            <p class="mb-1"><?php echo $confide_item['deskripsi']; ?></p>
            <small class="text-muted">
                <a href="#" class="text-secondary mr-2"><span class="fa fa-heart"></span> Likes</a>
                <a href="http://m.kaca-beta.com/details/<?php echo $confide_item['id'];?>#kolom-komentar" class="text-secondary mr-2"><span class="fa fa-comment"></span> Comments</a>
                <a href="#" class="text-secondary"><span class="fa fa-share-square"></span> Shares</a>
            </small>
        </li>

        <?php } ?>

    </ul>
</div>

<!-- Modal Pengikut -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengikut</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php foreach ($avatar_follower as $afer) { ?>
            <a style="color: black; text-decoration: none;" href="http://m.kaca-beta.com/user/<?= $afer['username']; ?>">
                <div class="media mb-3">
                    <!-- Photo Profile -->
                    <img style="object-fit:cover;width:45px;height:45px;" class="vorder mr-3 rounded-circle" src="
                    <?php if($afer['nama_avatar'] == true){ ?>
                    <?php echo "http://kaca-beta.com/images/avatar/".$afer['nama_avatar']; ?>
                    <?php }else{ ?>
                    <?php echo base_url("assets/img/user.png");} ?>
                    " alt="Generic placeholder image" style="max-width:50px;max-height:50px;">
                    <!-- End Photo Profile -->
                    <div class="media-body">
                        <p style="font-weight:600" class="my-0 py-0 text-capitalize"><?= $afer['full_name'];?></p>
                        <small><?= $afer['username'];?></small>
                    </div>
                </div>
            </a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal Mengikuti -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mengikuti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php foreach ($avatar_follow as $af) { ?> 
            <a style="color: black; text-decoration: none;" href="http://m.kaca-beta.com/user/<?= $af['username']; ?>">
                <div class="media mb-3">
                    <!-- Photo Profile -->
                    <img style="object-fit:cover;width:45px;height:45px;" class="vorder mr-3 rounded-circle" src="
                    <?php if($af['nama_avatar'] == true){ ?>
                    <?php echo "http://kaca-beta.com/images/avatar/".$af['nama_avatar']; ?>
                    <?php }else{ ?>
                    <?php echo base_url("assets/img/user.png");} ?>
                    " alt="Generic placeholder image" style="max-width:50px;max-height:50px;">
                    <!-- End Photo Profile -->
                    <div class="media-body">
                        <p style="font-weight:600" class="my-0 py-0 text-capitalize"><?= $af['full_name'];?></p>
                        <small><?= $af['username'];?></small>
                    </div>
                </div>
            </a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
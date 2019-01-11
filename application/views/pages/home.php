<style>
    video{
        width: 100%;
        height: auto;
    }
</style>
<div class="container-fluid my-5 py-3">
    <h2><b>Home</b></h2>
    <?php echo form_open("auth/search","class='mb-3'"); ?>
        <input class="form-control bg-light border-0" type="text" placeholder="Cari User" name="txt_username">
    <?php echo form_close(); ?>
    <ul class="list-group list-group-flush">
        <?php foreach ($content as $content_item) { ?>

        <li class="list-group-item">
            <div class="media">
                <!-- Start Photo -->
                <img class="mr-3 rounded" src="
                <?php if($content_item['nama_avatar'] == true){ ?>
                <?php echo "http://kaca-beta.com/images/avatar/".$content_item['nama_avatar']; ?>
                <?php }else{ ?>
                <?php echo base_url("assets/img/user.png");} ?>
                " alt="Generic placeholder image" style="max-width:50px;max-height:50px;min-height: 50px;">
                <!-- End Photo -->
                <div class="media-body">
                    <div class="row">
                        <div class="col-9">
                            <a class="text-dark" href="http://m.kaca-beta.com/user/<?php echo $content_item['username']; ?>"><h6 class="mt-0 text-capitalize"><?php echo $content_item['full_name']; ?></h6></a>
                        </div>
                        <div class="col-3">
                            <?php if ($_SESSION['user_id'] == $content_item['user_id']) { ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-link dropdown-toggle btn-sm text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                  <a href="<?php echo site_url('edit/'.$content_item['username'].'/'.$content_item['id']); ?>" class="dropdown-item">Edit</a>
                                  <a href="<?php echo site_url('delete/'.$content_item['id']); ?>" class="dropdown-item">Delete</a>
                              </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <h6 class="small text-secondary"><?php echo date("j F Y", strtotime($content_item['created_at'])); ?></h6>
                </div>
            </div>
            <?php if(
                    $content_item['tipe_file'] == 'image/png' ||
                    $content_item['tipe_file'] == 'image/jpeg'
                    ){ ?>
            <img class="img-fluid rounded mt-2" src="<?php echo "http://kaca-beta.com/images/".$content_item['nama_file']; ?>" alt="img">
            <?php }else if($content_item['tipe_file'] == 'video/mp4'){?>
            <video class="mt-2 rounded" width="595" controls>
                <source src="<?php echo "http://kaca-beta.com/videos/".$content_item['nama_file']; ?>" type="<?php echo $content_item['tipe_file']; ?>">
            </video>
            <h5><?php echo $content_item['judul']; ?></h5>
            <?php }else{} ?>
            <p class="my-2"><?php echo $content_item['deskripsi']; ?></p>
            <small class="text-muted">
                <a href="#" class="text-secondary mr-2"><span class="fa fa-heart"></span> Likes</a>
                <a href="http://m.kaca-beta.com/details/<?php echo $content_item['id'];?>#kolom-komentar" class="text-secondary mr-2"><span class="fa fa-comment"></span> Comments</a>
                <a href="#" class="text-secondary"><span class="fa fa-share-square"></span> Shares</a>
            </small>
        </li>

        <?php } ?>

    </ul>
</div>
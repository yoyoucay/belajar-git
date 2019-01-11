<div class="container-fluid my-5 py-3">
    <h2>
        <b><a onclick="goBack()" class="text-dark btn btn-transparent fa fa-arrow-left"></a>Details</b>
    </h2>

    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="media">
                <img class="mr-3 rounded" src="
                        <?php if($details['nama_avatar'] == true){ ?>
                        <?php echo "http://kaca-beta.com/images/avatar/".$details['nama_avatar']; ?>
                        <?php }else{ ?>
                        <?php echo base_url("assets/img/user.png");} ?>
                " alt="Generic placeholder image" style="max-width:50px;max-height:50px;min-height:50px;">
                <div class="media-body">
                    <h6 class="mt-0"><?php echo $details['full_name']; ?></h6>
                    <h6 class="small text-secondary"><?php echo date("j F Y", strtotime($details['created_at'])); ?></h6>
                </div>
            </div>
            <?php if(
            $details['tipe_file'] == 'image/png' ||
            $details['tipe_file'] == 'image/jpeg'
            ){ ?>
                <img class="img-fluid rounded mt-2" src="http://kaca-beta.com/images/<?php echo $details['nama_file']; ?>" alt="img">
            <?php }else if($details['tipe_file'] == 'video/mp4'){?>
                <video class="mt-3 rounded" width="595" controls>
                    <source src="<?php echo "http://kaca-beta.com/videos/".$details['nama_file']; ?>" type="<?php echo $details['tipe_file']; ?>">
                </video>
            <?php }else{}?>
            <p class="mb-1"><?php echo $details['deskripsi']; ?></p>
            
            <!-- Likes -->
            <small class="text-muted mr-2">
                <!-- Start Like -->
                <?php if(@$_SESSION['user_id'] == TRUE){ ?>
                    <?php if($check_suka == FALSE){ ?>
                        <?php echo form_open('confide/likeConfide','class="d-inline-flex"'); ?>
                        <input type="hidden" name="id_status" value="<?= $details['id']; ?>">
                        <input type="hidden" name="id_user" value="<?= $user['id'];?>">
                        <button class="btn btn-link btn-sm text-secondary px-0"><span class="fa fa-heart"></span></button>
                        <?php echo form_close(); ?>
                        <?php if ($count_suka['status_like'] == 0) {
                            echo "";
                        }else{
                            echo $count_suka['status_like'];
                        }?>
                    <?php }else{ ?>
                        <?php echo form_open('confide/unlikeConfide','class="d-inline-flex"'); ?>
                        <input type="hidden" name="id_status" value="<?= $details['id']; ?>">
                        <input type="hidden" name="id_user" value="<?= $user['id'];?>">
                        <button class="btn btn-link btn-sm text-danger px-0"><span class="fa fa-heart"></span></button>
                        <?php echo form_close(); ?>
                        <?php if ($count_suka['status_like'] == 0) {
                            echo "";
                        }else{
                            echo $count_suka['status_like'];
                        }?>
                    <?php } ?>
                <?php } ?>
                <!-- End Like -->
            </small>
            <!-- Shares -->
            <small class="text-muted">
                <button class="btn btn-link btn-sm text-secondary"><span class="fa fa-share mb-2"></span></button>
            </small>
            <!-- Comments -->
            <div class="my-2">
                <span class="text-muted mr-2">
                    <?php echo $count_comment['jumlah_kiriman']; ?> Komentar
                </span>
            </div>
            
            <!-- Comments form -->
            <?php echo form_open('confide/insert_comment'); ?>
                <div class="form-group" id="kolom-komentar">
                    <input type="hidden" name="confide_id" value="<?= $details['id'];?>">
                    <input type="hidden" name="user_id" value="<?= $user['id'];?>">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment_txt"></textarea>
                    <input type="submit" class="btn btn-primary btn-sm btn-block mt-3" value="Kirim">
                </div>
            <?php echo form_close(); ?>

            <?php foreach($comment as $comment_item) { ?>
            <div class="media mb-3">
                <div class="media-body">
                    <h6 class="mt-0 text-capitalize"><?= $comment_item['full_name']; ?> <span class="small text-secondary"><?php echo date("j F Y", strtotime($comment_item['created_at'])); ?></span></h6>
                    <span class="small"><?= $comment_item['deskripsi'];?></span><br>
                    <!-- Likes Comments -->
                    <small class="text-muted mr-2">
                        <span class="fa fa-thumbs-up"></span>
                        100
                    </small>
                    <!-- Reply Comments -->
                    <small>Reply</small>
                </div>
            </div>
            <?php } ?>
            
        </li>
    </ul>
</div>
<div class="container-fluid mt-5 pt-3">
    <h2>
        <b><a onclick="goBack()" class="text-dark btn btn-transparent fa fa-arrow-left"></a>User</b>
    </h2>
    <ul class="list-group list-group-flush">
        <?php foreach($users as $search_show){ ?>
        <li class="list-group-item">
            <div class="media">
                <!-- Start Photo -->
                <img class="mr-3 rounded-circle" src="
                    <?php 
                    if($search_show->nama_avatar == FALSE){
                        echo base_url("assets/img/user.png");
                    }else{
                        echo "http://kaca-beta.com/images/avatar/".$search_show->nama_avatar;
                    } ?>
                " alt="Generic placeholder image" style="max-width:50px;max-height:50px;">
                <!-- End Photo -->
                <div class="media-body">
                    <a href="http://m.kaca-beta.com/user/<?php echo $search_show->username; ?>"><h6 class="mt-0 text-capitalize"><?php echo $search_show->full_name?></h6></a>
                    <small><?php echo $search_show->username; ?></small>
                </div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
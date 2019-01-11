<div class="container-fluid my-5 py-3">
    <h2>
        <b><a href="#" class="text-dark btn btn-transparent fa fa-arrow-left"></a>Chats</b>
    </h2>
    <form class="mb-3">
        <input class="form-control bg-light border-0" type="text" placeholder="Cari User">
    </form>

    <?php foreach ($online as $on) { ?> 
        <a style="color: black; text-decoration: none;" href="http://m.kaca-beta.com/chat/<?= $on['username']; ?>">
            <div class="media mb-3">
                <!-- Photo Profile -->
                <img style="object-fit:cover;width:45px;height:45px;" class="vorder mr-3 rounded-circle" src="
                <?php if($on['nama_avatar'] == true){ ?>
                <?php echo "http://kaca-beta.com/images/avatar/".$on['nama_avatar']; ?>
                <?php }else{ ?>
                <?php echo base_url("assets/img/user.png");} ?>
                " alt="Generic placeholder image" style="max-width:50px;max-height:50px;">
                <!-- End Photo Profile -->
                <div class="media-body">
                    <p style="font-weight:600" class="my-0 py-0 text-capitalize"><?= $on['full_name'];?></p>
                    <small class="text-secondary">Offline</small>
                </div>
            </div>
        </a>
    <?php } ?>
</div>
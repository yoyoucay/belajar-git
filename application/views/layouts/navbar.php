<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    <a href="http://m.kaca-beta.com/user/<?php echo $user['username']; ?>">Profile</a>
    <a href="http://m.kaca-beta.com/settings">Settings</a>
    <a href="http://m.kaca-beta.com/logout">Log out</a>
  </div>
</div>

<div id="myNav2" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
  <div class="overlay-content">
    <a href="#">Hello</a>
    <?php echo form_open("auth/search"); ?>
        <input class="form-control mr-sm-2 btn btn-outline-light" type="search" placeholder="Search" aria-label="Search" name="txt_username" style="width: 80%;margin: auto;">
    <?php echo form_close(); ?>
</div>
</div>

<nav class="navbar fixed-top navbar-light bg-white">
    <a class="navbar-brand" href="http://m.kaca-beta.com/home">
        <img class="img-fluid" src="<?php echo base_url("assets/img/Logo1.png"); ?>" alt="Logo 2" width="80">
    </a>
    <span>
        <span class="fa fa-search mr-3 text-secondary" onclick="openNav2()" style="cursor:pointer"></span>
        <?php if(@$_SESSION['logged_in'] == true){ ?>
            <img class="rounded-circle" src="
                <?php if($user['nama_avatar'] == true){ ?>
                <?php echo "http://kaca-beta.com/images/avatar/".$user['nama_avatar']; ?>
                <?php }else{ ?>
                <?php echo base_url("assets/img/user.png");} ?>
            " alt="" width="30" height="30" onclick="openNav()" style="cursor:pointer">
        <?php }else{ ?>
            
        <?php } ?>
    </span>
</nav>

<script type="text/javascript">
/* Open */
function openNav() {
    document.getElementById("myNav").style.height = "100%";
}

/* Close */
function closeNav() {
    document.getElementById("myNav").style.height = "0%";
}

/* Open */
function openNav2() {
    document.getElementById("myNav2").style.height = "100%";
}

/* Close */
function closeNav2() {
    document.getElementById("myNav2").style.height = "0%";
}
</script>
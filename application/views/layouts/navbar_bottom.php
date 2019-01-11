<ul class="nav nav-pills nav-fill fixed-bottom bg-light border-top">
  <li class="nav-item">
    <a class="nav-link fa fa-home text-dark h4 pt-3" href="http://localhost/project/mobileweb/home"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link fa fa-bell text-dark h4 pt-3" href="#" data-toggle="tooltip" title="Sedang Perbaikan"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link fa fa-plus-circle text-dark h4 pt-3"href="http://localhost/project/mobileweb/input"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link fa fa-comment text-dark h4 pt-3" href="chat"  data-toggle="tooltip" title="Sedang Perbaikan"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link h4 mt-1" href="http://localhost/project/mobileweb/user/<?php echo $user['username']; ?>">
        <img class="rounded-circle" src="
            <?php if($user['nama_avatar'] == true){ ?>
            <?php echo "http://localhost/project/mobileweb/images/avatar/".$user['nama_avatar']; ?>
            <?php }else{ ?>
            <?php echo base_url("assets/img/user.png");} ?>
        " alt="" width="25" height="25" style="cursor:pointer">
    </a>
  </li>
</ul>
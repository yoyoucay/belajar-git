<nav class="navbar navbar-light bg-light fixed-top border-bottom">
  <a class="navbar-brand mr-auto" href="#">
  <span class="fa fa-bars mr-2" onclick="openNav()" style="cursor:pointer"></span>
    Kaca
  </a>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </ul>
  </div>

    <a class="btn btn-transparent fa fa-play-circle text-dark" href="#"  data-toggle="tooltip" data-placement="bottom" title="Soon"></a>
    <a class="btn btn-transparent fa fa-music text-dark" href="#"  data-toggle="tooltip" data-placement="bottom" title="Soon"></a>
    <a class="btn btn-transparent fa fa-shopping-bag text-dark" href="#"  data-toggle="tooltip" data-placement="bottom" title="Soon"></a>
</nav>

<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    <a href="http://m.kaca-beta.com/logout">Log out</a>
  </div>
</div>

<Style>
/* Navbar */

.overlay {
  height: 0%;
  width: 100%;
  position: fixed;
  z-index: 1031;
  top: 0;
  left: 0;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.9);
  overflow-y: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: center;
  margin-top: 30px;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.overlay a:hover,
.overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay {
    overflow-y: auto;
  }

  .overlay a {
    font-size: 20px
  }

  .overlay .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
  }
}

 /*End Navbar */
</Style>

<script type="text/javascript">
    /* Open */
    function openNav() {
        document.getElementById("myNav").style.height = "100%";
    }
    
    /* Close */
    function closeNav() {
        document.getElementById("myNav").style.height = "0%";
    }
</script>
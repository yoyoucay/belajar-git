<!-- Header -->
<nav class="navbar navbar-light bg-light fixed-top">
<a class="navbar-brand mr-auto" href="http://m.kaca-beta.com/chat">
  <span class="fa fa-arrow-left mr-2"></span>
    <b class="text-capitalize"><?php echo $user_item['username'];?></b>
  </a>
</nav>

<div class="container-fluid my-5 py-2">
    <div id="pesan">
        <?php foreach ($chat as $list){
            if($list->send_by != $user['id']){
                ?>
                <div class="media my-3">
                    <img src="https://via.placeholder.com/50" class="mr-3 rounded" alt="...">
                    <div class="media-body text-secondary">
                    <?php echo "$list->chat_id"." $list->message"; ?>
                    </div>
                </div>
                <?php
                }
            else{
                ?>
                <div class="alert alert-secondary ml-4" role="alert">
                    <?php echo "$list->chat_id"." $list->message"; ?>
                </div>
                <?php
                    }
                 
            }
    ?>
    </div>
</div>
<ul class="nav nav-pills nav-fill fixed-bottom bg-transparent">
    <form class="form-inline mx-auto">
        <input type="hidden" id="send_to" name="send_to" value="<?php echo $user_item['id']; ?>">
        <input type="hidden" id="send_by" name="send_by" value="<?php echo $user['id']; ?>">
        <input type="hidden" id="id_sesi" name="id_sesi" value="<?php echo $_SESSION['user_id']; ?>">
        <div class="form-group mx-sm-3 mb-2 mr-2">
            <input type="text" name="message" id="message" class="form-control" placeholder="Pesan anda..">
        </div>
        <input type="button" value="Kirim" class="btn btn-primary mb-2" onclick="store();">
    </form>
</ul>
    
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e40a215b58bb53333b27', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
    //   alert(JSON.stringify(data));
    addData(data);
    });

    function addData(data) {
        var str = '';
        for(var z in data){
            if( data[ z ].send_by == $('#id_sesi').val() ){
                str += '<div class="alert alert-secondary ml-4" role="alert">';
                    str += '<span>'+data[ z ].message+'</span>';
                str += '</div>';
            }else{
                str += '<div class="media my-3">';
                    str += '<img src="https://via.placeholder.com/50" class="mr-3 rounded" alt="...">';
                    str += '<div class="media-body text-secondary">';
                        str += '<span>'+data[ z ].message+'</span>';
                    str += '</div>';
                str += '</div>';
            }
        }
        $('#pesan').html(str);
    }
</script>    
<script>
    function store() {
    var value = {
        send_to: $('#send_to').val(),
        send_by: $('#send_by').val(),
        message: $('#message').val()
    }

    $.ajax({
        url: '<?= site_url();?>confide/sendchat',
        type: 'POST',
        data: value,
        dataType: 'JSON'
    });
}
</script>
<div class="container-fluid my-5 py-3">
    <h2>
        <b><a onclick="goBack()" class="text-dark btn btn-transparent fa fa-arrow-left"></a>Edit</b>
    </h2>
    
     <?php echo form_open('confide/update_confide/'.$content['username'].'/'.$content['id']); ?>
        <input type="hidden" name="user_id" id="" value="<?php echo $_SESSION['user_id']; ?>">
        <textarea class="form-control" name="input_deskripsi" id="exampleFormControlTextarea1" rows="3" style="max-height: 150px;min-height: 150px;"><?php echo $content['deskripsi']; ?></textarea>
        <input type="submit" name="submit" class="btn btn-primary my-3 btn-block" value="Edit">
    <?php echo form_close(); ?>

</div>
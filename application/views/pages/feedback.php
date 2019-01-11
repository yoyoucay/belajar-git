<div class="container mt-5" style="max-width: 600px;">
    <?php echo form_open('auth/set_feedback'); ?>
    <input type="hidden" name="txt_userid" value="<?php echo $_SESSION['user_id']; ?>">
    <div class="form-group">
        <label for="exampleFormControlInput1">Judul Feedback</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Judul" name="txt_judulfeedback">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Isi Feedback</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="txt_isifeedback" placeholder="Tulis disini.."></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Feedback</button>
    <?php echo form_close();?>
</div>
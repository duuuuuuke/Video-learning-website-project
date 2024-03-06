<div class="container mt-5">
    <div class="col-4 offset-4 my-5">
        <?php if ($this->session->flashdata('edit-success')) : ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $this->session->flashdata('edit-success'); ?>
            </div>
        <?php endif ?>

        <?php if ($this->session->flashdata('edit-fail')) : ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $this->session->flashdata('edit-fail'); ?>
            </div>
        <?php endif ?>

        <?php echo form_open(base_url() . 'index.php?/profile/update_info'); ?>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" required="required" name="username" value="<?php echo $info[0]['username']; ?>">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Email" required="required" name="email" value="<?php echo $info[0]['email']; ?>">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
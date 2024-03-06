<div class="container my-5">
    <?php echo form_open_multipart(base_url() . 'index.php?/upload/uploadFile'); ?>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Title" required="required" name="title">
    </div>
    <div class="form-group">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Please write the description" required="required" name="description"></textarea>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-4 col-md-offset-6 centered">
            <?php if ($this->session->flashdata('upload_result')) : ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $this->session->flashdata('upload_result'); ?>
                </div>
            <?php endif ?>
            <div class="form-group">
                <label>Drag or select files here</label>
                <input type="file" name="userfiles[]" multiple>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Upload">
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <h3></h3>
</div>
<div class="main"> </div>

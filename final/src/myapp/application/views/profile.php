<div class="container my-5">

    <h2>Profile</h2>
    <!-- main content -->
    <?php if ($this->session->flashdata('profile_no_login')) : ?>
        <div class="alert alert-danger mt-3">
            <?php echo $this->session->flashdata('profile_no_login'); ?>
        </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('info not found')) : ?>
        <div class="alert alert-danger mt-3">
            <?php echo $this->session->flashdata('info not found'); ?>
        </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('profile-message')) : ?>
        <div class="alert alert-danger mt-3">
            <?php echo $this->session->flashdata('profile-message'); ?>
        </div>
    <?php endif ?>

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo validation_errors(); ?>
        </div>
    <?php endif ?>

    <div class="mt-4">
        <h4>Username</h4>
        <?php echo $username; ?>
    </div>

    <div class="mt-4">
        <h4>Email</h4>
        <?php echo $email; ?>
    </div>

    <div class="mt-3">
        <a href="<?php echo base_url(); ?>index.php?/profile/edit_profile" class="btn btn-primary">Edit</a>
    </div>

    <h3 class="mt-5">Wishlist</h3>

    <div class="row my-5" id="cards">
        <?php if ($allWishlist) :?>
            <?php foreach($allWishlist->result() as $row) :?>
                <div class="col-sm mb-3" id="<?php echo $row->id; ?>">
                    <div class="card" style="width: 18rem;"> 
                        <div class="card-body"> 
                            <h5 class="card-title"><?php echo $row->title;?></h5>
                            <p class="card-text"><?php echo $row->description;?></p>
                            <a href="<?php echo base_url(); ?>index.php?/detail/getProductId?title=<?php echo $row->title;?>" class="btn btn-primary mr-3">Buy</a>
                            <button type="button" class="btn btn-danger delete" data-text="<?php echo $row->title; ?>" data-id="<?php echo $row->id; ?>">Delete</button>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php else:?>
            Wishlist is empty.
        <?php endif;?>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var title = $(this).data('text');
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url(); ?>index.php?/profile/deleteWishlist",
                method: 'POST',
                data: {
                    username: '<?php echo $this->session->userdata('username'); ?>',
                    title: title
                },
                success: function(response) {
                    if (response == 'success') {
                        console.log('#'+id);
                        $("#"+id).fadeOut('slow');
                    }
                }
            });
        });      
    });
</script>

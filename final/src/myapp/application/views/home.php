<div class="container mt-5">
    <!-- show logged-in content -->
    <?php if ($this->session->userdata('logged_in')) : ?>
        <h1 class="my-5">Hello, <?php echo $this->session->userdata('username'); ?>!</h1>
    <?php endif; ?>

    <!-- main content -->
    <h3 class="mt-5">Courses</h3>

    <div class="mb-5" id="load_data">

    </div>

</div>

<script>
    $(document).ready(function() {

        var limit = 5;
        var start = 0;
        var active = false; // flag to show loading data or not

        // send request and load data.
        function load_data(limit, start) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php?/ajax/scroll_fetch",
                method: "POST",
                data: {
                    limit: limit,
                    start: start
                }, // send data to controller
                success: function(response) {
                    if (response == '') {
                        active = true;
                    } else {
                        $('#load_data').append(response);
                        active = false;
                    }
                }
            })
        }

        if (active == false) {
            active = true;
            load_data(limit, start);
        }

        // scroll loading
        $(document).scroll(function() {

            // see if the srollbar hit the bottom of the content and if there more data to load 
            if ($(window).scrollTop() >= $(document).height() - $(window).height() && active == false) {
                active = true;
                start = start + limit;
                // after 0.8s, load data
                setTimeout(function() {
                    load_data(limit, start);
                }, 500);
            }
        });
    });
</script>

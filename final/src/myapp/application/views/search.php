<div class="container my-5">

    <div class="col-md-12 col-md-offset-12 centered mb-0">
        <h1 class="text-center">Search</h1>

        <?php echo form_open(base_url() . 'index.php?/search/check'); ?>
        <div class="input-group mt-5">
            <input class="form-control" type="text" id="search_text" placeholder="Search" name="search" aria-label="Search">
            <!-- <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div> -->
        </div>
        <?php echo form_close(); ?>
    </div>

    <div class="col-md-8 centered ml-3 bg-light rounded">
        <div class="list-group mb-5 mt-0" id="result">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php?/ajax/fatch",
		method: "GET",
                data: {
                    query: query
                },
                success: function(response) {
                    $('#result').html("");
                    if (response == "") {
                        $('#result').html(response);
                    } else {
                        var obj = JSON.parse(response);
                        if (obj.length > 0) {
                            var items = [];
                            $.each(obj, function(i, val) {
                                items.push($('<a id="links" herf="' + '<?php echo base_url(); ?>index.php?/detail?productId=' + val.id + '"/>').text('Title:' + val.title + ' | ' + 'product id:' + val.id));
                                $('#result').append.apply($('#result'), items);
                            });

                        } else {
                            $('#result').html("Not Found!");
                        }
                    }
                }
            });
        }
        $('#search_text').keyup(function() {

            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });

        $(document).on('click', 'a', function() {

            var data = $('#links').text();
            var productId = data.split(":")[data.split(":").length - 1];
            window.location.href = '<?php echo base_url(); ?>index.php?/detail?productId=' + productId;
        });
    });
</script>

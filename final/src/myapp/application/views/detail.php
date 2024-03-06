<div class="container my-5">

    <?php if ($type == 'video/mp4') : ?>
        <?php echo "<video width='320' height='240' controls>
            <source src='./uploads/" . $userid . "/" . $title . "/" . $filename . "' type='video/mp4'>
            Your browser does not support the video tag.
        </video>" ?>

    <?php endif ?>

    <?php if ($type == 'application/pdf') : ?>

        <form action="" method="post">
            <button class="btn btn-primary btn-lg" name="pdfview">View this document here</button>
        </form>

        <?php if (isset($_POST['pdfview'])) {
            // $path = './uploads/' . $userid . '/' . $title . '/' . $filename;
            // header("Content-type: application/pdf");
            // header("Content-Length: " . filesize($path));
            // readfile($path);

            // $file = './uploads/' . $userid . '/' . $title . '/' . $filename;
            // $filename = $filename;

            // // Header content type
            // header('Content-type: application/pdf');

            // header('Content-Disposition: inline; filename="' . $filename . '"');

            // header('Content-Transfer-Encoding: binary');

            // header('Accept-Ranges: bytes');

            // // Read the file
            // @readfile($file);

            // As I was using the methods above to show pdf files, chrome shows "failed to load pdf document" error. So I googled this method to solve the issue. Basically the pdf file is too large for readfile() to handle, but my pdf is only 100+KB.
            // Reference:
            // Chrome has “Failed to load PDF document” error message on inline PDFs. (2011, April 14). Stack  Overflow. https://stackoverflow.com/questions/5670785/chrome-has-failed-to-load-pdf-document-error-message-on-inline-pdfs
            $file = './uploads/' . $userid . '/' . $title . '/' . $filename;
            $fp = fopen($file, "r");

            header("Content-type: application/pdf");
            header('Content-Length:' . filesize($file));
            ob_clean();
            flush();
            // readFile($file);
            while (!feof($fp)) {
                $buff = fread($fp, 1024);
                print $buff;
            }
            exit;
        } ?>
    <?php endif ?>

    <?php if ($isLiked == 'true') : ?>
        <div class="container mt-5">
            <button class="btn btn-danger" id="likeBtn" type="button">like: <?php echo $likeCount; ?></button>
        </div>
    <?php else : ?>
        <div class="container mt-5">
            <button class="btn btn-outline-primary" id="likeBtn" type="button">like: <?php echo $likeCount; ?></button>
        </div>
    <?php endif; ?>

    <h2 class="mt-5"><?php echo $title; ?></h2>
    <p>uploaded by: <?php echo $product_username; ?></p>
    <p>product id: <?php echo $productId; ?></p>
    <h4 class="mt-5">Description:</h4>
    <p class="mt-3"><?php echo $description; ?></p>
    <h4 class="mt-5">Comments:</h4>
    <div class="input-group my-3">
        <input class="form-control" type="text" placeholder="Add a comment" name="addComment" id="newComment">
        <div class="input-group-append">
            <button class="btn btn-primary" id="subButton" type="submit">Add</button>
        </div>
    </div>
    <div class="comments">
        <?php if ($allComments) : ?>
            <?php foreach ($allComments->result() as $row) : ?>
                <div class="mb-5">
                    <h6><?php echo $row->username; ?></h6>
                    <p><?php echo $row->date; ?></p>
                    <p><?php echo $row->comments; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            No comments.
        <?php endif; ?>
    </div>
</div>
<script>
    $(window).scroll(function() {
        sessionStorage.scrollTop = $(this).scrollTop();
    });


    // add and show comments
    $(document).ready(function() {

        if (sessionStorage.scrollTop) {
            $(window).scrollTop(sessionStorage.scrollTop);
        }

        $('#subButton').click(function() {
            var newComment = $('#newComment').val();
            if (newComment != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php?/ajax/addComment",
                    method: 'POST',
                    data: {
                        product_id: '<?php echo $productId; ?>',
                        username: '<?php echo $this->session->userdata('username'); ?>',
                        comments: newComment,

                    },
                    success: function(response) {
                        var content = ''
                        var result = JSON.parse(response);
                        content += '<div class="mb-5"><h6>' + result[0].username + '</h6>';
                        content += '<p>' + result[0].date + '</p>';
                        content += '<p>' + result[0].comments + '</p></div>';

                        $('.comments').prepend(content);
                    }
                });
            }
        });

        var liked = '<?php echo $isLiked; ?>';
        $('#likeBtn').click(function() {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php?/likeBtn/handleLike",
                method: 'POST',
                data: {
                    product_id: '<?php echo $productId; ?>',
                    username: '<?php echo $this->session->userdata('username'); ?>',
                    liked: liked,
                },
                success: function(response) {
                    if (response != 'error' && liked == 'true') {
                        $('#likeBtn').removeClass('btn-danger');
                        $('#likeBtn').addClass('btn-outline-primary');
                        $('#likeBtn').text('like: ' + response);
                        liked = 'false';

                    } else if (response != 'error' && liked == 'false') {
                        $('#likeBtn').removeClass('btn-outline-primary');
                        $('#likeBtn').addClass('btn-danger');
                        $('#likeBtn').text('like: ' + response);
                        liked = 'true';
                    }
                }
            });
        });
    });
</script>
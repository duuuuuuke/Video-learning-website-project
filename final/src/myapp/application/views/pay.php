<div class="container">
    <h2 class="mt-5"><?php echo $title; ?></h2>
    <p>uploaded by: <?php echo $product_username; ?></p>
    <p id="product_id">product id: <?php echo $productId; ?></p>
    <h4 class="mt-5">Description:</h4>
    <p class="mt-3"><?php echo $description; ?></p>
    <h2 class="mt-5">You need to buy this course to view the content</h2>

    <?php if ($added) : ?>
        <button type="button" class="btn btn-primary mb-5" id="addBtn" disabled>Add to wishlist</button>
    <?php else : ?>
        <button type="button" class="btn btn-primary mb-5" id="addBtn">Add to wishlist</button>
    <?php endif; ?>


    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '88.44'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For demo purposes:
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    // var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    actions.redirect('<?php echo base_url(); ?>index.php?/detail/paid?username=<?php echo $this->session->userdata('username'); ?>&title=<?php echo $title; ?>&productId=<?php echo $productId; ?>');

                });
            }

        }).render('#paypal-button-container');
    </script>
</div>
<script>
    $(document).ready(function() {
        $('#addBtn').click(function() {
            if (product_id != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php?/profile/addToWishlist",
                    method: 'POST',
                    data: {
                        product_id: '<?php echo $productId; ?>',
                        username: '<?php echo $this->session->userdata('username'); ?>',
                        description: '<?php echo $description; ?>',
                        title: '<?php echo $title; ?>'
                    },
                    success: function(response) {
                        if (response == 'success') {
                            $('#addBtn').attr("disabled", true);
                        }
                    }
                });
            }
        });
    });
</script>
<!-- <!DOCTYPE html> -->
<html>

<head>
  <title>MyProject</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <a class="navbar-brand" href="#">My Project</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="navbar-nav ml-5">
        <a class="nav-item nav-link" href="<?php echo base_url(); ?>index.php?/">Home </a>
      </div>
      <div class="navbar-nav my-lg-0 ml-auto mr-2">
        <?php if (!$this->session->userdata('logged_in')) : ?>
          <a href="<?php echo base_url(); ?>index.php?/login" class="nav-item nav-link"> Login </a>
        <?php endif; ?>
        <?php if ($this->session->userdata('logged_in')) : ?>
          <a href="<?php echo base_url(); ?>index.php?/upload" class="nav-item nav-link"> Upload </a>
        <?php endif; ?>
        <?php if ($this->session->userdata('logged_in')) : ?>
          <a href="<?php echo base_url(); ?>index.php?/profile" class="nav-item nav-link"> Profile </a>
        <?php endif; ?>
        <?php if ($this->session->userdata('logged_in')) : ?>
          <a href="<?php echo base_url(); ?>index.php?/login/logout" class="nav-item nav-link"> Logout </a>
        <?php endif; ?>
      </div>

    </div>
   


  </nav>

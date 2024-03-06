<div class="container mt-5">
	<div class="col-4 offset-4 my-5">
		<?php if ($this->session->flashdata('success')) : ?>
			<div class="alert alert-primary" role="alert">
				<?php echo $this->session->flashdata('success'); ?>
			</div>
		<?php endif ?>
		<?php if ($this->session->flashdata('send_email')) : ?>
			<div class="alert alert-primary" role="alert">
				<?php echo $this->session->flashdata('send_email'); ?>
			</div>
		<?php endif ?>

		<?php if ($this->session->flashdata('error')) {
			echo $this->session->flashdata('error');
		} ?>

		<?php if ($this->session->flashdata('captcha')) {
			echo $this->session->flashdata('captcha');
		} ?>

		<?php echo form_open(base_url() . 'index.php?/login/check_login'); ?>
		<h2 class="text-center my-5">Login</h2>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Username" required="required" name="username">
		</div>
		<div class="form-group mt-5">
			<input type="password" class="form-control" placeholder="Password" required="required" name="password">
		</div>

		<div class="form-group">
			<?php echo $error; ?>
		</div>
		<div class="clearfix my-3">
			<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block">Log in</button>
		</div>
		<div class="clearfix">
			<p>Don't have an account? <a href="<?php echo base_url(); ?>index.php?/signup" class="ml-2">Sign up</a></p>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

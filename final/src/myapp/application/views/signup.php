<div class="container mt-5">
	<div class="col-4 offset-4 my-5">
		<?php if ($this->session->flashdata('message')) : ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif ?>
		<?php if ($this->session->flashdata('fail verified')) : ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $this->session->flashdata('fail verified'); ?>
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

		<?php echo form_open(base_url() . 'index.php?/signup/register'); ?>
		<h2 class="text-center my-5">Sign up</h2>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Username" required="required" name="username">
		</div>
		<div class="form-group mt-5">
			<input type="email" class="form-control" placeholder="Email" required="required" name="email">
		</div>
		<div class="form-group mt-5">
			<input type="password" class="form-control" placeholder="Password" required="required" name="password">
		</div>
		<div class="form-group mt-5">
			<input type="password" class="form-control" placeholder="Confirm your password" required="required" name="confirmed_password">
		</div>
		
		<div class="form-group">
			<?php echo $error; ?>
		</div>
		<div class="form-group mt-5">
			<button type="submit" class="btn btn-primary btn-block">Sign up</button>
		</div>
		<div class="clearfix">
			<p>Have an account? <a href="<?php echo base_url(); ?>index.php?/login" class="ml-2">Login</a></p>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<div class="container">
	<div class="row unit1">
		<div class="span4">
			<h1>Welcome to CodeIgniter!</h1>

			<div id="body">
				<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

				<p>If you would like to edit this page you'll find it located at:</p>
				<code>application/views/welcome_message.php</code>

				<p>The corresponding controller for this page is found at:</p>
				<code>application/controllers/welcome.php</code>

				<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
			</div>
		</div>
		<div class="span4">
			<a href="<?=base_url();?>user/logout">logout</a>
			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
		</div>
			<?php
			echo '<div class="span4">';
			$attributes = array('class' => 'form-signin', 'id' => 'login_form');
			echo form_open('home/blog', $attributes);
			echo '<h3 class="form-signin-heading">Post your steps!</h3>';
			$data = array(
					'name'	=> 'distace',
					'id'    => 'distance',
					'class' => 'input-block-level',
					'value' => '',
					'placeholder' => 'Distance',
			        );
			echo form_input($data);
			
			$data = array(
					'name'	=> 'description',
					'id'    => 'discription',
					'class' => 'input-block-level',
					'value' => '',
			        );
			echo form_password($data);

			$data = array(
					'name'	=> 'date',
					'id'    => 'date',
					'class' => 'input-block-level',
					'value' => '',
			        );
			echo form_password($data);
			echo '<button class="btn btn-large btn-primary" type="submit">Sign in</button>';
			echo '</div>';
			?>
	</div>
</div>
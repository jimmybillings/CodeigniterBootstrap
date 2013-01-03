<?php
echo '<div class="container">';
	echo '<div class="row unit1">';
    	echo '<div class="span4">';
			echo validation_errors(); 
			$attributes = array('class' => 'form-signin', 'id' => 'login_form');
			echo form_open('user/login', $attributes);
			echo '<h3 class="form-signin-heading">Please sign in</h3>';
			$data = array(
					'name'	=> 'email',
					'id'    => 'email',
					'class' => 'input-block-level',
					'value' => '',
					'placeholder' => 'Email',
			        );
			echo form_input($data);
			$data = array(
					'name'	=> 'password',
					'id'    => 'password',
					'class' => 'input-block-level',
					'value' => '',
			        );
			echo form_password($data);
			echo '<button class="btn btn-large btn-primary" type="submit">Sign in</button>';
			echo '<a href="<?=base_url()?>user/create">Create an account</a>';
		echo '</div>';
		echo '<div class="span8">';
			echo '<p>This is a lightweight starter kit for Codeigniter. It includes a built in user / login system, and a microblog.</p>';
		echo '</div>';
	echo '</div>';
echo '</div>';

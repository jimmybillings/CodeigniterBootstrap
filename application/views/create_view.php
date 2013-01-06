<?php
	echo '<div class="container">';
	echo '<div class="row unit1">';
    	echo '<div class="span4">';
			$attributes = array('class' => 'create_account form-signin', 'id' => 'create_account');
			echo form_open('user/create', $attributes);
			echo '<h3 class="form-signin-heading">Create your account</h3>';
	      	
	      	echo validation_errors(); 

			echo form_label('What is your Name', 'name');

			echo form_input(	array(
								'name'	=> 'name',
								'id'    => 'name',
								'class' => 'input-block-level',
								'value' => set_value('name'),
								'placeholder' => 'Whats your name',
			        			)
							);

			echo form_label('What is your Email', 'email');
			$data = array(
					'name'	=> 'email',
					'id'    => 'email',
					'class' => 'input-block-level',
					'value' => set_value('email'),
					'placeholder' => 'Email address',
			        );
			echo form_input($data);

			echo form_label('Create password', 'password');
			$data = array(
					'name'	=> 'password',
					'id'    => 'password',
					'class' => 'input-block-level',
					'value' => set_value('password'),
			        );
			echo form_password($data);

			echo form_label('Confirm password', 'password2');
			$data = array(
					'name'	=> 'password2',
					'id'    => 'password2',
					'class' => 'input-block-level',
					'value' => set_value('password2'),
			        );
			echo form_password($data);

			echo '<p class="form-signin-heading">Incase you forget your password. Create a question and answer that only you will know.</p>';

			echo form_label('Secret Question', 'question');
			$data = array(
					'name'	=> 'question',
					'id'    => 'question',
					'class' => 'input-block-level',
					'value' => set_value('question'),
			        );
			echo form_input($data);

			echo form_label('Secret Answer', 'answer');
			$data = array(
					'name'	=> 'answer',
					'id'    => 'answer',
					'class' => 'input-block-level',
					'value' => set_value('answer'),
			        );
			echo form_input($data);

			echo '<button class="btn btn-large btn-primary" type="submit">Create</button>';
			echo '<a href="'.base_url().'user" class="btn fr">Login</a>';
			

		echo '</div>';
	echo '</div>';
echo '</div>';
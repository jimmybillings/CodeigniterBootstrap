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
			echo '<button class="btn btn-primary" type="submit">Login</button>';
			echo '<a href="'.base_url().'user/create" class="btn fr" type="button">Create Account</a>';
			echo '<a href="#myModal" data-toggle="modal" class="bl">Forgot Password</a>';
			echo form_close();
		echo '</div>';
		echo '<div class="span8">';
			echo '<p>This is a lightweight starter kit for Codeigniter. It includes a built in user / login system, and a microblog.</p>';
		echo '</div>';
	echo '</div>';
echo '</div>';


echo '<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
  echo '<div class="modal-header">';
    echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    echo '<h3 id="myModalLabel">Tell us your email</h3>';
  echo '</div>';
  echo '<div class="modal-body">';
    echo '<p>Enter your email address and we\'ll ask your secret question.</p>';
	$attributes = array('class' => 'forgotpassword', 'id' => 'forgotpass');
	echo form_open('user/forgotpassword', $attributes);
    echo '<input type="text" name="email" id="forgottext" placeholder="email"/>';
  echo '</div>';
  echo '<div class="modal-footer">';
    echo '<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
    echo '<button id="get-question" class="btn btn-primary">Get question</button>';
  echo '</div>';
echo '</div>';

echo '<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
  echo '<div class="modal-header">';
    echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    echo '<h3 id="myModalLabel">Answer your Secret question</h3>';
  echo '</div>';
  echo '<div class="modal-body">';
    echo '<p class="questionarea">Enter your email address and we\'ll ask your secret question.</p>';
	$attributes = array('class' => 'forgotpassword', 'id' => 'check');
	echo form_open('user/checkquestion', $attributes);
    echo '<input type="text" name="answer" id="answer" placeholder="answer"/>';
  echo '</div>';
  echo '<div class="modal-footer">';
    echo '<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
    echo '<button id="checkanswer" class="btn btn-primary">Check Answer</button>';
  echo '</div>';
echo '</div>';

echo '<div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
  echo '<div class="modal-header">';
    echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    echo '<h3 id="myModalLabel">Reset your password</h3>';
  echo '</div>';
  echo '<div class="modal-body">';
	$attributes = array('class' => 'resetpassword', 'id' => 'reset');
	echo form_open('user/reset', $attributes);
    echo '<input type="text" name="password1" class="fl" id="password1" placeholder="password"/>';
    echo '<input type="text" name="password2" class="fr" id="password2" placeholder="retype password"/>';
    echo '<input type="hidden" name="user_id" id="user_id" />';
    echo '<input type="hidden" name="emailchange" id="emailchange" />';
  echo '</div>';
  echo '<div class="modal-footer">';
    echo '<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
    echo '<button id="resetpass" class="btn btn-primary">Check Answer</button>';
  echo '</div>';
echo '</div>';

echo '<div id="myModal4" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
  echo '<div class="modal-header">';
    echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    echo '<h3 id="myModalLabel">Congratulations, your password has been reset.</h3>';
  echo '</div>';
  echo '<div class="modal-body">';
  echo '</div>';
  echo '<div class="modal-footer">';
    echo '<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
  echo '</div>';
echo '</div>';


?>
<script>
$(function(){

	$('#get-question').on('click', function(e) {

		e.preventDefault();
		query_params = 'email='+$('#forgottext').val();
		$('#forgotpass').attr('id', 'checking');
		console.log(query_params);
		$.ajax({
			type: 'POST',       
			url: '<?=base_url();?>user/forgotpassword',
			data: query_params,
			dataType: 'json',

			success: function(string){
				$('#myModal').modal('hide')
				$('.questionarea').html('your question is: '+string.question);
				$('#myModal2').modal('show');
				
			}	
		});
	});

	$('#checkanswer').on('click', function(e) {
		
		e.preventDefault();
		var params = 'answer='+$('#answer').val();
		console.log(params);
		$.ajax({
			type: 'POST',       
			url: '<?=base_url();?>user/checkquestion',
			data: params,
			dataType: 'json',

			success: function(string){
				if (string != null) {
					$('#user_id').val(string.user_id);
					$('#emailchange').val(string.email);
					$('#myModal2').modal('hide')
					$('#myModal3').modal('show');
				} else {
					$('.questionarea').append(' <span style="color:red;">Incorrect</span>');
					$('#answer').css({'border':'1px solid red'});
				}
			},

		});
	});

	$('#resetpass').on('click', function(e) {
		e.preventDefault();
		
		if ($('#password1').val() === $('#password2').val() 
			&& $('#password1').val() !== '') {

			var params = 'password='+$('#password1').val()+'&user_id='+$('#user_id').val()+'&emailchange='+$('#emailchange').val();
			console.log(params);
			$.ajax({
				type: 'POST',       
				url: '<?=base_url();?>user/updatepassword',
				data: params,
				dataType: 'json',

				success: function(string){
					$('#myModal3').modal('hide')
					$('#myModal4').modal('show');
				}	
			});

		} else {

			$('#password1, #password2').css({'border':'1px solid red'});
		}
		
		
	});
})
</script>



 


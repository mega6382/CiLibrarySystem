<html>
<?php if (isset($this->session->userdata['logged_in'])) { header("location: http://localhost/library/index.php/auth/login"); } ?>

<head>
    <title>Registration Form</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
</head>

<body>
    <div>
        <div>
            <h2>Registration Form</h2>
            <hr/>
			<div>
			 <?= validation_errors();?>
			 </div>
			 <?= form_open('auth/registerdb', ['class'=> "pure-form pure-form-stacked"])?>
			 <?= form_label('Create Username : ')?>
			 <br/>
			 <?= form_input('username')?>
			 <div>
				<?= isset($message_display) ? $message_display : ''?>
			 </div>
			 <br/>
			 <?= form_label( 'Email : ') ?>
			 <br/>
			 <?php $data = array( 'type'=> 'email', 'name' => 'email' );
			 echo form_input($data);?>
			 <br/>
			 <br/>
			 <?= form_label('Password : ')?>
			 <br/>
			 <?= form_password('password')?>
			 <br/>
			 <br/>
			 <?= form_submit('submit', 'Sign Up')?>
			 <?= form_close()?>

            <a href="<?php echo base_url() ?> ">For Login Click Here</a>
        </div>
    </div>
</body>

</html>
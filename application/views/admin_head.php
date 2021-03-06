<html>
<?php 

$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
?>
<style>
#profile
{
	margin-bottom:20px;
    line-height: 50px;
	background:#12423e;
	color:#fff;
}
.menu 
{
	display:inline-block;
	background:#183835;
    margin-left: 115px;
    width: 25%;
    text-align: center;
}
.menu a
{
	color:#fff;
	text-decoration:none;
}
</style>
<head>
    <title>Admin Panel</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">

</head>
<body>
    <div id="profile">
		<span><?= "Hello <b><i>$username</i> !</b>" ?></span>
		<span>Welcome to Admin Panel</span>
		<div class="menu">
			<a href="<?= base_url() ?>">Home</a> |
			<a href="<?php echo base_url() ?>index.php/admin/manage_books">Manage Books</a> |
			<a href="<?php echo base_url() ?>index.php/admin/add_rack">Add Rack</a> |
			<a href="<?php echo base_url() ?>index.php/admin/add_book">Add Book</a>
		</div>
        <b id="logout" style="float:right;"><a href="<?= base_url() ?>index.php/auth/logout" style="color:#fff;">Logout</a></b>
    </div>

	<div>
		<?= isset($message_display) ? $message_display : ''?>
	</div>
<?php
session_start();
if($_SESSION['loggedIn'] !== true) { ?>
		<script>
			alert("You are not Logged In !!!");
			alert("Login to continue");
			location.replace("login.php");
		</script>
	<?php }
session_destroy();
?>
<script>
	location.replace("login.php");
</script>
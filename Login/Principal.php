<?php 
	session_start();

	if (isset($_GET['param'])){
		if ($_GET['param'] == 'logout') {
			session_destroy();
		}
	}
?>

<script type="text/javascript">
	document.location = "index.php";
</script>

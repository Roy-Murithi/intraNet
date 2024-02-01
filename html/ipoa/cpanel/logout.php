<?php
session_start();
$_SESSION['loggedIn']!="";
$_SESSION['user']="";
$_SESSION['level']="";
session_destroy();
?>
<script language="javascript">
	window.parent.document.location="../index.php";
</script>

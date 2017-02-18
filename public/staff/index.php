<?php
require_once('../../private/initialize.php');
?>

<?php require_login();
	echo phpversion() . "</br>";
	foreach(session_get_cookie_params() as $key => $value){
		echo $key . '= ' . $value . "</br>";
	}
?>
<?php $page_title = 'Staff: Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="main-content">

  <h1>Menu</h1>
  <ul>
    <li>
      <a href="users/index.php">Users</a>
    </li>
    <li>
      <a href="salespeople/index.php">Salespeople</a>
    </li>
    <li>
      <a href="countries/index.php">Countries, States, &amp; Territories</a>
    </li>
  </ul>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

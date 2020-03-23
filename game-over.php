<?php
// Start the session - this is needed before anything else to get session variables
session_start();

$pageTitle = "Game Over. Final Score: " . $_SESSION["playerScore"];

include('inc/header.php');

?>

<h1>GAME OVER!!!</h1>

<?php
include('inc/footer.php');
?>
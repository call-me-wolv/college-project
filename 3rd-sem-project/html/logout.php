<?php
session_start();
session_unset();
session_destroy();
header("Location: /");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="includes/style.css">

</head>
</body>
<script>
function closeWin() {
    myWindow.close();
}
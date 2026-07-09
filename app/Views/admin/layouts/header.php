<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>GuestConnect Admin</title>

<link rel="stylesheet" href="/css/admin.css">

</head>
<?php

use GuestConnect\Core\Session;

?>

<?php if($message = Session::getFlash('success')): ?>

<div class="alert success">

    <?= htmlspecialchars($message) ?>

</div>

<?php endif; ?>

<body>

<div class="admin-wrapper">

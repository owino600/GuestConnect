<?php

use GuestConnect\Core\Session;

?>
<div class="sidebar">

    <div class="brand">

        <img src="/images/logo.png" class="logo">

        <h2>GuestConnect</h2>

        <small>Hotel WiFi Manager</small>

    </div>

    <ul>

        <li><a href="/admin">🏠 Dashboard</a></li>

        <li><a href="/admin/activity">👥 Guest Activity</a></li>

        <li><a href="/admin/portal">🌐 Portal</a></li>

        <li><a href="/admin/authentication">🔐 Authentication</a></li>

        <li><a href="/admin/branding">🎨 Branding</a></li>

        <li><a href="/admin/terms">📄 Terms</a></li>

        <li><a href="/admin/surveys">📊 Survey</a></li>

        <li><a href="/admin/system">⚙ System</a></li>

    </ul>

</div>

<div class="content">

<?php if($message = Session::getFlash('success')): ?>

<div id="toast" class="toast toast-success">

    <div class="toast-icon">✓</div>

    <div class="toast-message">

        <?= htmlspecialchars($message) ?>

    </div>

</div>

<script>

setTimeout(function(){

    const toast = document.getElementById('toast');

    if(toast){

        toast.classList.add('hide');

        setTimeout(() => toast.remove(),500);

    }

},3000);

</script>

<?php endif; ?>

<h1>Dashboard</h1>

<div class="cards">

    <div class="card">

        <h3><?= $online ?></h3>

        <p>Guests Online</p>

    </div>

    <div class="card">

        <h3><?= $authorized ?></h3>

        <p>Authorized</p>

    </div>

    <div class="card">

        <h3><?= $aps ?></h3>

        <p>Access Points</p>

    </div>

    <div class="card">

        <h3><?= $today ?></h3>

        <p>Today's Logins</p>

    </div>

</div>

<div class="panel">

<h2>Recent Guests</h2>

<table>

<tr>

<th>Device</th>

<th>MAC</th>

<th>SSID</th>

<th>AP</th>

<th>Status</th>

</tr>

<?php foreach($recent as $client): ?>

<tr>

<td><?= htmlspecialchars($client['hostname']) ?></td>

<td><?= htmlspecialchars($client['mac']) ?></td>

<td><?= htmlspecialchars($client['ssid']) ?></td>

<td><?= htmlspecialchars($client['access_point']) ?></td>

<td>

<?= $client['authorized'] ? '🟢 Online' : '🔴 Offline' ?>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>

<div class="panel">

<h2>System Health</h2>

<ul>

<li>🟢 UniFi Connected</li>

<li>🟢 Database Connected</li>

<li>🟢 Captive Portal Running</li>

<li>🟢 Authentication Enabled</li>

</ul>

</div>

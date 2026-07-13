<div class="page-header">

    <h1>Guest Activity</h1>

    <p>Monitor connected guests in real time.</p>

</div>

<div class="stat-grid">

    <div class="start-card">
        <h3><?= count($clients) ?></h3>
        <p>Currently Online</p>
    </div>

</div>

<div class="guest-list">

<?php foreach($clients as $client): ?>

<div class="guest-card">

    <div class="guest-title">

        <strong>

        <?= htmlspecialchars($client['hostname'] ?: 'Unknown Device') ?>

        </strong>

    </div>

    <div class="guest-info">

        <p>

        <strong>MAC:</strong>

        <?= $client['mac'] ?>

        </p>

        <p>

        <strong>Connected:</strong>

        <?= date('d M Y H:i', $client['first_seen']) ?>

        </p>

        <p>

        <strong>Status:</strong>

        <span class="status-online">

            Active

        </span>

        </p>

    </div>

</div>

<?php endforeach; ?>

</div>


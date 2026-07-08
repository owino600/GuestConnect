<h1>Dashboard</h1>

<p class="page-description">
    Welcome to the GuestConnect Administration Portal.
</p>

<div class="dashboard-grid">

    <div class="dashboard-card">

        <h3>🌐 Portal</h3>

        <span class="status online">Online</span>

        <p><?= htmlspecialchars($settings['portal_name']) ?></p>

    </div>

    <div class="dashboard-card">

        <h3>🔑 Authentication</h3>

        <strong>

            <?= ucfirst($settings['authentication_type']) ?>

        </strong>

    </div>

    <div class="dashboard-card">

        <h3>📝 Survey</h3>

        <strong>

            <?= $settings['survey_enabled'] ? 'Enabled' : 'Disabled' ?>

        </strong>

    </div>

    <div class="dashboard-card">

        <h3>📡 UniFi</h3>

        <span class="status online">

            Connected

        </span>

    </div>

</div>

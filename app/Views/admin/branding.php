<h1>Branding</h1>

<p class="page-description">
Customize how guests see your Wi-Fi portal.
</p>

<form method="POST" action="/admin/branding" enctype="multipart/form-data">

    <div class="card">

        <label>Portal Name</label>

        <input
            type="text"
            name="portal_name"
            value="<?= htmlspecialchars($settings['portal_name']) ?>">

    </div>

    <div class="card">

        <label>Welcome Heading</label>

        <input
            type="text"
            name="welcome_heading"
            value="<?= htmlspecialchars($settings['welcome_heading']) ?>">

    </div>

    <div class="card">

        <label>Welcome Message</label>

        <textarea
            name="welcome_message"
            rows="4"><?= htmlspecialchars($settings['welcome_message']) ?></textarea>

    </div>

    <div class="card">

        <label>Primary Color</label>

        <input
            type="color"
            name="primary_color"
            value="<?= htmlspecialchars($settings['primary_color']) ?>">

    </div>

    <div class="card">

        <label>Secondary Color</label>

        <input
            type="color"
            name="secondary_color"
            value="<?= htmlspecialchars($settings['secondary_color']) ?>">

    </div>

    <button class="btn">

        Save Branding

    </button>

</form>


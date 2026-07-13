<div class="form-container">

    <div class="page-header">
        <h1 class="page-title">Portal Settings</h1>
        <p class="page-subtitle">
            Configure how your Wi-Fi portal appears to guests.
        </p>
    </div>

    <div class="form-card">

        <form method="POST" action="/admin/portal">

            <div class="form-group">
                <label>Portal Name</label>
                <input
                    type="text"
                    name="portal_name"
                    value="<?= htmlspecialchars($settings['portal_name'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Welcome Message</label>

                <textarea
                    rows="5"
                    name="welcome_message"><?= htmlspecialchars($settings['welcome_message'] ?? '') ?></textarea>

            </div>

            <button class="btn-primary">
                Save Changes
            </button>

        </form>

    </div>

</div>

<h1>Portal Settings</h1>

<form method="POST" action="/admin/portal">

    <div class="card">

        <label>Portal Name</label>

        <input
            type="text"
            name="portal_name"
            value="<?= htmlspecialchars($settings['portal_name']) ?>">

    </div>

    <div class="card">

        <label>Welcome Message</label>

        <textarea
            name="welcome_message"
            rows="5"><?= htmlspecialchars($settings['welcome_message']) ?></textarea>

    </div>

    <button class="btn">

        Save Changes

    </button>

</form>

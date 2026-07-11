<h2>Authentication Settings</h2>

<?php if (!empty($_SESSION['success'])): ?>

<p style="color:green;">
    <?= $_SESSION['success']; ?>
</p>

<?php unset($_SESSION['success']); ?>

<?php endif; ?>

<form method="POST" action="/admin/authentication">

    <div class="form-group">

        <label>Authentication Method</label>

        <select name="authentication_method">

            <option value="password"
                <?= ($settings['authentication_method'] ?? 'password') == 'password' ? 'selected' : '' ?>>
                Password
            </option>

            <option value="voucher"
                <?= ($settings['authentication_method'] ?? '') == 'voucher' ? 'selected' : '' ?>>
                Voucher
            </option>

            <option value="pin"
                <?= ($settings['authentication_method'] ?? '') == 'pin' ? 'selected' : '' ?>>
                PIN
            </option>

        </select>

    </div>

    <div class="form-group">

        <label>Wi-Fi Password</label>

        <input
            type="text"
            name="wifi_password"
            value="<?= htmlspecialchars($settings['wifi_password'] ?? '') ?>">

    </div>

    <button type="submit">

        Save Authentication

    </button>

</form>

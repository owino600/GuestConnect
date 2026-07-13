<div class="form-container">

    <div class="page-header">

        <h1 class="page-title">
            Authentication
        </h1>

        <p class="page-subtitle">
            Configure how guests authenticate before accessing Wi-Fi.
        </p>

    </div>

    <div class="form-card">

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

            <button class="btn-primary">
                Save Authentication
            </button>

        </form>

    </div>

</div>

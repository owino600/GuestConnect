<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>

    <?= htmlspecialchars($settings['portal_name']) ?>

    Guest Wi-Fi

    </title>

    <link rel="stylesheet" href="/css/portal.css">
    <style>

    :root{

        --primary-color:
        <?= htmlspecialchars($settings['primary_color']) ?>;

        --secondary-color:
        <?= htmlspecialchars($settings['secondary_color']) ?>;

    }

    </style>

</head>

<body>

<div class="background">

    <div class="login-card">

        <div class="logo">

            <img src="/images/logo.png" alt="Burch's Resort">

        </div>

        <h1>

        <?= htmlspecialchars($settings['portal_name']) ?>

        </h1>
        <h2>

        <?= htmlspecialchars($settings['welcome_heading']) ?>

        </h2>

        <p class="subtitle">

            <?= htmlspecialchars($settings['welcome_message']) ?>

        </p>

        <?php if($showSurvey): ?>

            <div class="survey">

                🎉 We'd love your feedback after your stay.

            </div>

        <?php endif; ?>

        <form action="/authorize" method="POST">

            <div class="form-group">

                <label>

                    <?= htmlspecialchars($auth['label']) ?>

                </label>

                <input
                    type="<?= $auth['type'] === 'password' ? 'password' : 'text' ?>"
                    name="credential"
                    placeholder="<?= htmlspecialchars($auth['placeholder']) ?>"
                    required>

            </div>

            <div class="terms">

                <label>

                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        required>

                    I have read and agree to the

                    <a href="#" id="viewTerms">

                        Terms & Conditions

                    </a>

                </label>

            </div>

            <input
                type="hidden"
                name="mac"
                value="<?= htmlspecialchars($mac) ?>">

            <input
                type="hidden"
                name="url"
                value="<?= htmlspecialchars($url) ?>">

            <button
                type="submit"
                id="connectBtn"
                disabled>

                Login

            </button>

        </form>

        <div class="footer">

            Powered by GuestConnect

        </div>

    </div>

</div>

<div id="termsModal" class="modal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Terms & Conditions</h2>

            <span class="close">&times;</span>

        </div>

        <div class="modal-body">

            <p>

                <?= nl2br(htmlspecialchars($settings['terms_conditions'])) ?>

            </p>

        </div>

    </div>

</div>

<script src="/js/portal.js"></script>

</body>

</html>

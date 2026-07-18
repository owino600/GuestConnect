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

        --primary-color: <?= htmlspecialchars($settings['primary_color'] ?? '#2563eb') ?>;
        --secondary-color: <?= htmlspecialchars($settings['secondary_color'] ?? '#ffffff') ?>;

    }

    .background{

    <?php if(!empty($settings['background_image'])): ?>

        background:
            linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)),
            url("/images/uploads/<?= htmlspecialchars($settings['background_image']) ?>");

        background-size: cover;
        background-position: center;

    <?php else: ?>

        background: <?= htmlspecialchars($settings['background_color'] ?? '#f5f7fb') ?>;

    <?php endif; ?>

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

        <?php if ($survey['show']): ?>

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

            <?php if (!empty($_SESSION['error'])): ?>

                <div class="error-message">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>

            <div class="terms">

                <label class="terms-label">

                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        required>

                    <span>

                        I have read and agree to the

                        <a href="#" id="viewTerms">

                            Terms & Conditions

                        </a>

                    </span>

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

            <input
                type="hidden"
                name="token"
                value="<?= htmlspecialchars($token ?? '') ?>">

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

<!-- Survey Providers -->
<script src="/js/providers/FormbricksProvider.js"></script>

<!-- Provider Factory -->
<script src="/js/providers/ProviderFactory.js"></script>

<!-- Survey Engine -->
<script src="/js/survey.js"></script>

<!-- Launch Survey -->
<?php if ($survey['show']): ?>

<script>

document.addEventListener("DOMContentLoaded", async () => {

    const survey = new GuestSurvey({

        show: <?= json_encode($survey['show']) ?>,

        provider: <?= json_encode($survey['provider']) ?>,

        configuration: <?= json_encode($survey['configuration']) ?>

    });

    await survey.launch();

});

</script>

<?php endif; ?>

<!-- Portal Logic -->
<script src="/js/portal.js"></script>

</body>

</html>

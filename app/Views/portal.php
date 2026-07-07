<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Burch's Resort Guest Wi-Fi</title>

    <link rel="stylesheet" href="/css/portal.css">

</head>

<body>

<div class="background">

    <div class="login-card">

        <!-- Resort Logo -->

        <div class="logo">

            <img src="/images/logo.png" alt="Burch's Resort">

        </div>

        <!-- Heading -->

        <h1>Burch's Resort</h1>

        <p class="subtitle">

            Enjoy Endless and Secure internet connectivity.

        </p>

        <!-- Login Form -->

        <form action="/authorize" method="POST">

            <!-- Authentication -->

            <div class="form-group">

                <label for="password">

                    Password

                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter Password">

            </div>

            <!-- Terms -->

            <div class="terms">

                <label>

                    <input
                        type="checkbox"
                        id="terms"
                        name="terms">

                    I have read and agree to the

                    <a href="#" id="viewTerms">

                        Terms & Conditions

                    </a>

                </label>

            </div>

            <!-- Hidden UniFi Values -->

            <input
                type="hidden"
                name="mac"
                value="<?= htmlspecialchars($mac) ?>">

            <input
                type="hidden"
                name="url"
                value="<?= htmlspecialchars($url) ?>">

            <!-- Login -->

            <button
                type="submit"
                id="connectBtn"
                disabled>

                Login

            </button>

        </form>

    </div>

</div>

<!-- Terms Modal -->

<div id="termsModal" class="modal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Terms & Conditions</h2>

            <span class="close">&times;</span>

        </div>

        <div class="modal-body">

            <p>

                Your Terms & Conditions will appear here.

            </p>

        </div>

    </div>

</div>

<script src="/js/portal.js"></script>

</body>

</html>

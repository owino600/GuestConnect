<div class="form-container">

    <div class="page-header">

        <h1 class="page-title">
            Branding
        </h1>

        <p class="page-subtitle">
            Customize your GuestConnect portal appearance.
        </p>

    </div>

    <div class="form-card">

        <form method="POST" action="/admin/branding" enctype="multipart/form-data">

            <div class="form-group">

                <label>Portal Name</label>

                <input
                    type="text"
                    name="portal_name"
                    value="<?= htmlspecialchars($settings['portal_name'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label>Welcome Heading</label>

                <input
                    type="text"
                    name="welcome_heading"
                    value="<?= htmlspecialchars($settings['welcome_heading'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label>Welcome Message</label>

                <textarea
                    rows="5"
                    name="welcome_message"><?= htmlspecialchars($settings['welcome_message'] ?? '') ?></textarea>

            </div>

            <div class="color-grid">

                <div class="form-group">

                    <label>Primary Color</label>

                    <input
                        type="color"
                        name="primary_color"
                        value="<?= $settings['primary_color'] ?? '#00695C' ?>">

                </div>

                <div class="form-group">

                    <label>Secondary Color</label>

                    <input
                        type="color"
                        name="secondary_color"
                        value="<?= $settings['secondary_color'] ?? '#FFFFFF' ?>">

                </div>

            </div>

            <div class="form-group">

                <label>Background Colour</label>

                <input
                    type="color"
                    name="background_color"
                    value="<?= htmlspecialchars(
                        $settings['background_color'] ?? '#f5f7fb'
                    ) ?>">

                <button
                    type="submit"
                    name="reset_background_colour"
                    class="btn-secondary">

                    Reset Colour

                </button>

            </div>

            <div class="form-group">

                <label>Portal Background</label>

                <input
                    type="file"
                    name="background_image"
                    id="backgroundImage"
                    accept="image/*">

                <?php if (!empty($settings['background_image'])): ?>

                    <div class="current-background">

                        <img
                            src="/images/uploads/<?= htmlspecialchars($settings['background_image']) ?>"
                            alt="Portal Background">

                        <div class="background-details">

                            <strong>Current Image</strong>

                            <p><?= htmlspecialchars($settings['background_image']) ?></p>

                        </div>

                    </div>

                <?php else: ?>

                    <p class="no-background">
                        No background image selected.
                    </p>

                <?php endif; ?>

                <button
                    type="submit"
                    name="delete_background"
                    class="btn-danger">

                    Delete Image

                </button>

            </div>

            <button class="btn-primary">

                Save Branding

            </button>

        </form>

    </div>

</div>
<script src="/js/branding.js"></script>

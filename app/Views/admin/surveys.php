<h1>Survey Settings</h1>

<form method="POST" action="/admin/surveys">

    <!-- Survey Provider -->

    <div class="form-group">

        <label>Survey Provider</label>

        <select id="survey_provider" name="survey_provider">

            <option value="formbricks"
                <?= ($settings['survey_provider'] ?? '') === 'formbricks' ? 'selected' : '' ?>>
                Formbricks
            </option>

            <option value="google"
                <?= ($settings['survey_provider'] ?? '') === 'google' ? 'selected' : '' ?>>
                Google Forms
            </option>

            <option value="microsoft"
                <?= ($settings['survey_provider'] ?? '') === 'microsoft' ? 'selected' : '' ?>>
                Microsoft Forms
            </option>

            <option value="typeform"
                <?= ($settings['survey_provider'] ?? '') === 'typeform' ? 'selected' : '' ?>>
                Typeform
            </option>

            <option value="survicate"
                <?= ($settings['survey_provider'] ?? '') === 'survicate' ? 'selected' : '' ?>>
                Survicate
            </option>

            <option value="custom"
                <?= ($settings['survey_provider'] ?? '') === 'custom' ? 'selected' : '' ?>>
                Custom Survey
            </option>

        </select>

        <small
            id="providerDescription"
            class="provider-description">
        </small>

    </div>

    <!-- Display Method -->

    <div class="form-group">

        <label>Display Method</label>

        <div id="displayMethodContainer">

            <!-- Generated automatically by survey.js -->

        </div>

    </div>

    <!-- Formbricks -->

    <div id="formbricksSettings">

        <div class="form-group">

            <label>Survey URL</label>

            <input
                type="text"
                name="survey_url"
                value="<?= htmlspecialchars($settings['survey_url'] ?? '') ?>">

        </div>

        <div class="form-group">

            <label>Environment ID</label>

            <input
                type="text"
                name="survey_environment_id"
                value="<?= htmlspecialchars($settings['survey_environment_id'] ?? '') ?>">

        </div>

        <div class="form-group">

            <label>Survey Identifier</label>

            <input
                type="text"
                name="survey_identifier"
                value="<?= htmlspecialchars($settings['survey_identifier'] ?? '') ?>">

        </div>

    </div>

    <!-- Google Forms -->

    <div id="googleSettings" style="display:none;">

        <div class="form-group">

            <label>Google Form URL</label>

            <input
                type="text"
                name="google_form_url"
                value="<?= htmlspecialchars($settings['google_form_url'] ?? '') ?>">

        </div>

    </div>

    <!-- Microsoft Forms -->

    <div id="microsoftSettings" style="display:none;">

        <div class="form-group">

            <label>Microsoft Form URL</label>

            <input
                type="text"
                name="microsoft_form_url"
                value="<?= htmlspecialchars($settings['microsoft_form_url'] ?? '') ?>">

        </div>

    </div>

    <!-- Typeform -->

    <div id="typeformSettings" style="display:none;">

        <div class="form-group">

            <label>Typeform URL</label>

            <input
                type="text"
                name="typeform_url"
                value="<?= htmlspecialchars($settings['typeform_url'] ?? '') ?>">

        </div>

    </div>

    <!-- Survicate -->

    <div id="survicateSettings" style="display:none;">

        <div class="form-group">

            <label>Survicate URL</label>

            <input
                type="text"
                name="survicate_url"
                value="<?= htmlspecialchars($settings['survicate_url'] ?? '') ?>">

        </div>

    </div>

    <!-- Custom -->

    <div id="customSettings" style="display:none;">

        <div class="form-group">

            <label>Custom Survey URL</label>

            <input
                type="text"
                name="custom_survey_url"
                value="<?= htmlspecialchars($settings['custom_survey_url'] ?? '') ?>">

        </div>

    </div>

    <!-- Timing -->

    <div class="form-group">

        <label>Show Survey After</label>

        <div style="display:flex; gap:10px;">

            <input
                type="number"
                min="1"
                name="survey_delay"
                value="<?= htmlspecialchars($settings['survey_delay'] ?? 6) ?>">

            <select name="survey_unit">

                <option value="minutes"
                    <?= ($settings['survey_unit'] ?? '') === 'minutes' ? 'selected' : '' ?>>
                    Minutes
                </option>

                <option value="hours"
                    <?= ($settings['survey_unit'] ?? 'hours') === 'hours' ? 'selected' : '' ?>>
                    Hours
                </option>

                <option value="days"
                    <?= ($settings['survey_unit'] ?? '') === 'days' ? 'selected' : '' ?>>
                    Days
                </option>

            </select>

        </div>

    </div>

    <!-- Behaviour -->

    <div class="form-group">

        <label class="checkbox-label">

            <input
                type="checkbox"
                name="survey_show_once"
                <?= !empty($settings['survey_show_once']) ? 'checked' : '' ?>>

            Show survey only once

        </label>

    </div>

    <button
        type="submit"
        class="btn-primary">

        Save Survey Settings

    </button>

</form>

<script>

const currentDisplayMethod =
    <?= json_encode($settings['survey_display_method'] ?? 'popup') ?>;

</script>

<script src="/js/admin/survey.js"></script>


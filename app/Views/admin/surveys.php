<h1>Survey Settings</h1>

<form method="POST" action="/admin/surveys">

    <div class="form-group">

        <label>Survey Provider</label>

        <select name="survey_provider">

            <option value="formbricks"
                <?= ($settings['survey_provider'] ?? '') === 'formbricks' ? 'selected' : '' ?>>
                Formbricks
            </option>

        </select>

    </div>

    <div class="form-group">

        <label>Survey Identifier</label>

        <input
            type="text"
            name="survey_identifier"
            value="<?= htmlspecialchars($settings['survey_identifier'] ?? '') ?>">

    </div>

    <div class="form-group">

        <label>Survey Base URL</label>

        <input
            type="text"
            name="survey_url"
            value="<?= htmlspecialchars($settings['survey_url'] ?? '') ?>">

    </div>

    <div class="form-group">

        <label>Formbricks Environment ID</label>

        <input
            type="text"
            name="survey_environment_id"
            value="<?= htmlspecialchars($settings['survey_environment_id'] ?? '') ?>">

    </div>

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

    <div class="form-group">

        <label class="checkbox-label">

            <input
                type="checkbox"
                name="survey_show_once"
                <?= !empty($settings['survey_show_once']) ? 'checked' : '' ?>>

            Show survey only once

        </label>

    </div>

    <button type="submit" class="btn-primary">

        Save Survey Settings

    </button>

</form>

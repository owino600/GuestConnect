<?php

namespace GuestConnect\Services\Survey;

use GuestConnect\Services\SettingsService;

class FormbricksProvider implements SurveyProviderInterface
{
    private SettingsService $settings;

    public function __construct()
    {
        $this->settings = new SettingsService();
    }

    /**
     * Provider name.
     */
    public function getName(): string
    {
        return 'formbricks';
    }

    /**
     * Build launch URL.
     */
    public function getLaunchUrl(
        string $identifier,
        array $guest = []
    ): string
    {
        $baseUrl = rtrim(
            $this->settings->get('survey_url'),
            '/'
        );

        $url = $baseUrl . '/' . $identifier;

        /*
         |---------------------------------------------------------
         | Future personalization
         |---------------------------------------------------------
         */

        if (!empty($guest)) {

            $params = [];

            if (!empty($guest['id'])) {
                $params['guest'] = $guest['id'];
            }

            if (!empty($guest['mac_address'])) {
                $params['mac'] = $guest['mac_address'];
            }

            if (!empty($params)) {
                $url .= '?' . http_build_query($params);
            }
        }

        return $url;
    }

    /**
     * Completion callback.
     */
    public function markCompleted(array $payload): bool
    {
        /*
         * Formbricks webhook support
         * will be implemented later.
         */

        return true;
    }
}

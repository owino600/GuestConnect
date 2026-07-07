<?php

namespace GuestConnect\Services;

use GuestConnect\Core\Config;

class FormbricksService extends Service
{
    public function surveyUrl(string $mac): string
    {
        return rtrim(
            Config::get('FORMBRICKS_URL'),
            '/'
        ) . "?device=" . urlencode($mac);
    }
}

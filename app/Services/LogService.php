<?php

namespace GuestConnect\Services;

class LogService
{
    private string $logFile;

    public function __construct()
    {
        $this->logFile = __DIR__ . '/../../storage/logs/guestconnect.log';

        if (!is_dir(dirname($this->logFile))) {
            mkdir(dirname($this->logFile), 0775, true);
        }
    }

    public function info(string $message): void
    {
        $this->write('INFO', $message);
    }

    public function warning(string $message): void
    {
        $this->write('WARNING', $message);
    }

    public function error(string $message): void
    {
        $this->write('ERROR', $message);
    }

    private function write(string $level, string $message): void
    {
        $line = sprintf(
            "[%s] [%s] %s%s",
            date('Y-m-d H:i:s'),
            $level,
            $message,
            PHP_EOL
        );

        file_put_contents(
            $this->logFile,
            $line,
            FILE_APPEND | LOCK_EX
        );
    }
}

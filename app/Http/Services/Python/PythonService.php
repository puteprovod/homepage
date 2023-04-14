<?php

namespace App\Http\Services\Python;

class PythonService //SINGLETON PATTERN
{
    private static ?PythonService $instance = null;
    private const EXEC_COMMAND = 'python3';
    private const DEFAULT_PATH = '../';

    public static function start(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function execute(string $fileName, array $params, &$output): void
    {
        $execString = self::EXEC_COMMAND . ' ' . self::DEFAULT_PATH . $fileName . ' ' . implode(' ', $params);
        exec($execString, $output);
    }


}

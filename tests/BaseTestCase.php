<?php

namespace Tests;

require_once "./config/system.php";
use PHPUnit\Framework\TestCase as OriginalTestCase;

class BaseTestCase extends OriginalTestCase
{
    /**
     * setup
     * @return [type] [description]
     */
    public function setup()
    {
        $this->setEnv();
    }

    /**
     * Set Environment
     */
    public function setEnv()
    {
        config('env');
        if (getenv("APP_ENV") != "circle_ci") {
            $envs = parse_ini_file('test-env.ini', false);
            foreach ($envs as $env => $value) {
                putenv("{$env}={$value}");
            }
        }
    }
}

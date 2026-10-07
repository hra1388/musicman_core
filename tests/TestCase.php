<?php

namespace Tests;

use Exception;

class TestCase
{
    public function assertEquals(mixed $expected, mixed $actual, string $msg = ''): void
    {
        if ($expected !== $actual) {
            throw new Exception("Assertion Failed: Expected " . var_export($expected, true) . ", got " . var_export($actual, true) . ". " . $msg);
        }
    }

    public function assertTrue(mixed $condition, string $msg = ''): void
    {
        if ($condition !== true) {
            throw new Exception("Assertion Failed: Expected true, got " . var_export($condition, true) . ". " . $msg);
        }
    }

    public function assertFalse(mixed $condition, string $msg = ''): void
    {
        if ($condition !== false) {
            throw new Exception("Assertion Failed: Expected false, got " . var_export($condition, true) . ". " . $msg);
        }
    }
}

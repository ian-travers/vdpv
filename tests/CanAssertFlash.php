<?php

namespace Tests;

trait CanAssertFlash
{
    protected function assertFlash($type, $message)
    {
        $this->assertContains(
            $message,
            "Failed asserting that the flash message '$message' is present."
        );

        $this->assertContains(
            $type,
            "Failed asserting that the flash type '$type' is present."
        );
    }
}
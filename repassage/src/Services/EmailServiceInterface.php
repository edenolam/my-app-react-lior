<?php

namespace App\Services;

interface EmailServiceInterface
{
    public function sendEmail(string $to, string $subject, string $body): void;
}

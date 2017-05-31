<?php
namespace common;
use dtos\rates;

class rate_limiter
{
    public function tokens_count(string $application_id): int
    {
        return 0;
    }

    public function get_rate(string $application_id): rates
    {
        $rates = new rates();
        $rates->counter = 0;
        $rates->seconds = 0;

        return $rates;
    }

    public function can_generate_more_tokens(string $application_id): bool
    {
        $this->get_rate($application_id);
    }
}
<?php

namespace TsfCorp\Support\Tests;

use PHPUnit\Framework\TestCase;

class ExtractDateRangeTest extends TestCase
{
    public function test_it_returns_null_for_empty_string()
    {
        $this->assertNull(extract_date_range(''));
    }

    public function test_it_returns_null_for_invalid_format()
    {
        $this->assertNull(extract_date_range('dummy format'));
    }

    /**
     * assert that is generates a period object from a string which have the format: Y-m-d
     *
     * End date should be equal with the date passed
     */
    public function test_it_extract_date_range_from_single_date_string()
    {
        $period = extract_date_range('2020-06-01');

        $this->assertEquals('2020-06-01 00:00', $period->start_date->format('Y-m-d H:i'));
        $this->assertEquals('2020-06-01 23:59', $period->end_date->format('Y-m-d H:i'));
    }

    /**
     * assert that is generates a period object from a string which have the format: Y-m-d to Y-m-d
     */
    public function test_it_extract_date_range_from_date_range_string()
    {
        $period = extract_date_range('2020-06-01 to 2020-06-20');

        $this->assertEquals('2020-06-01 00:00', $period->start_date->format('Y-m-d H:i'));
        $this->assertEquals('2020-06-20 23:59', $period->end_date->format('Y-m-d H:i'));
    }

    /**
     * assert that is generates a period object from a string which have the format: Y-m-d to Y-m-d
     */
    public function test_it_extract_date_range_from_date_range_with_time_string()
    {
        $period = extract_date_range('2020-06-01 13:15 to 2020-06-20 21:45');

        $this->assertEquals('2020-06-01 13:15', $period->start_date->format('Y-m-d H:i'));
        $this->assertEquals('2020-06-20 21:45', $period->end_date->format('Y-m-d H:i'));
    }
}

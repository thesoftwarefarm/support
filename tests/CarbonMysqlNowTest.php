<?php

namespace TsfCorp\Support\Tests;

use Carbon\Carbon;

class CarbonMysqlNowTest extends TestCase
{
    public function test_carbon_mysql_now_returns_a_date_equal_with_server_date()
    {
        $mysql_now = carbon_mysql_now();
        $carbon_now = Carbon::now();

        $this->assertEquals($carbon_now->year, $mysql_now->year);
        $this->assertEquals($carbon_now->month, $mysql_now->month);
        $this->assertEquals($carbon_now->day, $mysql_now->day);
    }
}
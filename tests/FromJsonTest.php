<?php

namespace TsfCorp\Support\Tests;

use PHPUnit\Framework\TestCase;

class FromJsonTest extends TestCase
{
    public function test_json_decoded()
    {
        $json = '{"prop": "value"}';

        $decoded = from_json($json);

        $this->assertIsObject($decoded);
        $this->assertEquals('value', $decoded->prop);
    }

    public function test_default_value_is_returned_when_json_can_not_be_decoded()
    {
        $decoded = from_json(null, ['a' => 'b']);

        $this->assertIsArray($decoded);
        $this->assertEquals('b', $decoded['a']);
    }

    public function test_decode_as_array()
    {
        $json = '{"prop": "value"}';

        $decoded = from_json($json, [], $return_as_array = true);

        $this->assertIsArray($decoded);
        $this->assertEquals('value', $decoded['prop']);
    }
}
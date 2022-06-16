<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRouteTop()
    {
        $response = $this->get("/top");
        $response->assertStatus(200)->assertViewIs("テスト");
    }
}

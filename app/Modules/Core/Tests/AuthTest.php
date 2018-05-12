<?php

namespace App\Modules\Core\Tests;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testHello()
    {
        $response = $this->json('GET', '/');

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'SIMDES-API'
            ]);
    }
}

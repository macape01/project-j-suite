<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    /**
     * A test to check if a ticket can be listed
     *
     * @return void
     */
    public function test_ticket_can_be_listed()
    {
        //Responses
        $responseStatus = $this->get('/api/tickets');

        $response = $this->getJson('/api/tickets');
        
        //Assertions
        $responseStatus->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll('id', 'description', 'title', 'assigned_id', 'asset_id')
        );

    }
}

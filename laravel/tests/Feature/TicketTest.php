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
    public function test_tickets_can_be_listed()
    {
        //Responses
        $responseStatus = $this->get('/api/tickets');

        $response = $this->getJson('/api/tickets');
        
        //Assertions
        $responseStatus->assertStatus(200);
        /* $response->assertJson(fn (AssertableJson $json) =>
        $json->hasAll('id', 'description', 'title', 'assigned_id', 'asset_id')
        ); */

    }
    public function test_ticket_can_be_created()
    {
        //Mock data ticket

        $ticket_data = [
            'description' => 'tusa',
            'title' => 'hola',
            'assigned_id' => 1,
            'asset_id' => 2,
            'author_id' => 5,
        ];

        //Responses
        $response = $this->postJson('/api/tickets', $ticket_data);

        //Assertions
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);

    }
    public function test_ticket_can_be_retrieved()
    {
        //Responses
        $response = $this->get('/api/tickets/1');

        //Assertions
        $response->assertStatus(200);

    }
    public function test_ticket_can_be_updated()
    {
        //Mock data ticket

        $ticket_data = [
            'description' => 'amor',
            'title' => 'foda',
        ];

        //Responses
        $response = $this->put('/api/tickets/1', $ticket_data);

        //Assertions
        $response->assertStatus(200);

    }
    public function test_ticket_can_be_deleted()
    {

        //Responses
        $response = $this->delete('/api/tickets/1');

        //Assertions
        $response->assertStatus(200);

    }
}

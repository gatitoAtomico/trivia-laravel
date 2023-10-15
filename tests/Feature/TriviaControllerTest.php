<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SearchHistory; // Import your SearchHistory model
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TriviaControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware; // Disable middleware for testing.

    public function testStoreMethodSuccess()
    {
        $data = [
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'number_of_questions' => 10,
            'difficulty' => 'easy',
            'type' => 'multiple',
        ];

        $response = $this->post('api/updateTriviaHistory', $data);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'new history record created']);

        // Ensure the record was created in the database
        $this->assertDatabaseHas('search_history', [
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'number_of_questions' => 10,
            'difficulty' => 'easy',
            'type' => 'multiple',
        ]);
    }

    public function testStoreMethodValidationFailure()
    {
        $data = [
        ];

        $response = $this->post('api/updateTriviaHistory', $data);
        $response->assertStatus(422); // Ensure a validation error response
        $response->assertJsonStructure(['errors']);
        $this->assertDatabaseCount('search_history', 0);
    }
}

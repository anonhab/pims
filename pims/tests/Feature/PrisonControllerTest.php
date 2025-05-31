<?php

namespace Tests\Feature;

use App\Models\Prison;
use App\Models\Account;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class PrisonControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $account;

    protected function setUp(): void
    {
        parent::setUp();

        // Create the Lawyer role
        Role::factory()->create(['id' => 2, 'name' => 'Lawyer']);

        // Create a prison (no UUID, assuming id is bigint)
        $prison = Prison::factory()->create();

        // Create an account with role and prison relation
        $this->account = Account::factory()->create([
            'role_id' => 2,
            'prison_id' => $prison->id,
        ]);

        // Set session useruid to simulate login
        $this->withSession(['useruid' => $this->account->user_id]);
    }

    /** @test */
    public function test_it_creates_prison_with_valid_data()
    {
        $response = $this->post(route('prison.store'), [
            'name' => 'New Prison',
            'location' => 'Addis Ababa',
            'capacity' => 1000,
            'system_admin_id' => $this->account->user_id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('prisons', ['name' => 'New Prison']);
    }

    /** @test */
    public function it_fails_to_create_prison_with_missing_required_fields()
    {
        $response = $this->post(route('prison.store'), [
            'name' => '',
            'location' => '',
            'capacity' => '',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'location' => 'The location field is required.',
            'capacity' => 'The capacity field is required.',
        ]);
    }

    /** @test */
    public function it_fails_to_create_prison_with_duplicate_name()
    {
        Prison::factory()->create([
            'name' => 'Duplicate Prison',
        ]);

        $response = $this->post(route('prison.store'), [
            'name' => 'Duplicate Prison',
            'location' => 'East Wing',
            'capacity' => 50,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['name' => 'The name has already been taken.']);
    }

 
    /** @test */
    public function it_fails_to_create_prison_with_invalid_capacity()
    {
        $response = $this->post(route('prison.store'), [
            'name' => 'Test Prison',
            'location' => 'Downtown',
            'capacity' => -10,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['capacity']);
    }
}

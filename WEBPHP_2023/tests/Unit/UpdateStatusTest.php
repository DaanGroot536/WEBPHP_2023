<?php

namespace Tests\Feature;

use App\Models\Package;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testUpdateStatusRedirectsToGetStatusViewWhenUserIsAuthorized()
    {

        // Create a user with a 'deliverer' role
        $user = User::factory()->forRole('deliverer')->create();

        // Create a package
        $package = Package::factory()->create();

        // Make a POST request to the updateStatus route with the user's API token and the package ID and status
        $response = $this->actingAs($user)
            ->post(route('updateStatus'), [
                'api_token' => 'test_token',
                'packageID' => $package->id,
                'status' => 'delivered',
            ]);

        // Assert that the response has a 302 status code
        $response->assertStatus(302);

        // Assert that the response redirects to the getStatusView route
        $response->assertRedirect(route('getStatusView'));

        // Assert that the package status was updated
        $this->assertEquals('delivered', $package->fresh()->status);
    }

    /** @test */
    public function testUpdateStatusRedirectsToDashboardWhenUserIsNotAuthorized()
    {
        // Create a user with a 'customer' role
        $user = User::factory()->forRole('customer')->create();

        // Create a package
        $package = Package::factory()->create();

        // Make a POST request to the updateStatus route with the user's API token and the package ID and status
        $response = $this->actingAs($user)
            ->post(route('updateStatus'), [
                'api_token' => 'test_token',
                'packageID' => $package->id,
                'status' => 'delivered',
            ]);

        // Assert that the response has a 302 status code
        $response->assertStatus(302);

        // Assert that the response redirects to the dashboard route
        $response->assertRedirect(route('dashboard'));

        // Assert that the package status was not updated
        $this->assertNotEquals('delivered', $package->fresh()->status);
    }
}

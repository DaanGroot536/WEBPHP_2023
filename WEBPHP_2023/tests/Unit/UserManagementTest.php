<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * Test saveUser method.
     *
     * @return void
     */
    public function testSaveNewUserToDatabase()
    {
        // Create a new user
        $user = User::factory()->make();

        // Create a request object with user data
        $request = new Request([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'role' => 'webshop',
            'street' => $user->street,
            'housenumber' => $user->housenumber,
            'zipcode' => $user->zipcode,
            'city' => $user->city,
        ]);

        // Set the authenticated user for the request
        Auth::shouldReceive('user')->andReturn($user);

        // Create a new instance of the UserController
        $controller = new UserController();

        // Call the saveUser method with the request object
        $controller->saveUser($request);

        // Check that the user was saved to the database
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'webshop',
            'street' => $user->street,
            'housenumber' => $user->housenumber,
            'zipcode' => $user->zipcode,
            'city' => $user->city,
        ]);
    }
}

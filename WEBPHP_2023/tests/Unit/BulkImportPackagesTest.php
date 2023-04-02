<?php

namespace Tests\Feature;

use App\Models\Package;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BulkImportPackagesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function testBulkImportPackagesFromCsvFile()
    {
        // Create a user with a 'webshop' role
        $user = User::factory()->forRole('webshop')->create();

        // Create a fake CSV file with two packages
        $csvData = "Stad,Straatnaam,Postcode,Huisnummer,Dimensies, Gewicht\nAmsterdam, Keizersgracht, 1015 CJ, 24, 10x10x10,1400\nRotterdam,Witte de Withstraat,3012 BN,18,20x20x20,800";
        $csvFile = UploadedFile::fake()->createWithContent('packages.csv', $csvData);

        //Make a POST request with the fake csv file and api_token parameter
        $response = $this->actingAs($user)
            ->post(route('bulkImportCSV'), [
                'csv_file' => $csvFile,
                'api_token' => $user->api_token,
            ]);

        // Assert that the request was successful
        $response->assertStatus(302);

        // Assert that the response redirects to the correct route
        $response->assertRedirect(route('getPackages'));

        $packages = Package::all();

        // Assert that the correct number of packages have been created
        $this->assertCount(2, $packages);

        // Assert that each individual package is in the database
        foreach ($packages as $package) {
            $this->assertDatabaseHas('packages', [
                'id' => $package->id,
                'customerCity' => $package->customerCity,
                'customerStreet' => $package->customerStreet,
                'customerZipcode' => $package->customerZipcode,
                'customerHousenumber' => $package->customerHousenumber,
                'dimensions' => $package->dimensions,
                'weight' => $package->weight,
            ]);
        }
    }
}

<?php

namespace Tests\Feature;

use App\Http\Controllers\LabelController;
use App\Models\Label;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testSaveLabelSavesLabelToDatabaseAndRedirects()
    {
        // Create a package for testing
        $package = Package::factory()->create();

        // Call the saveLabel method on the controller
        $controller = new LabelController();
        $response = $controller->saveLabel(new Request([
            'packageID' => $package->id,
            'deliverer' => 'Test Deliverer',
        ]));

        // Assert that the label was saved to the database
        $this->assertDatabaseHas('labels', [
            'packageID' => $package->id,
            'deliverer' => 'Test Deliverer',
        ]);

        // Assert that the package was updated with the label ID
        $this->assertDatabaseHas('packages', [
            'id' => $package->id,
            'labelID' => Label::where('packageID', $package->id)->first()->id,
        ]);

        // Assert that the controller redirects to the correct route
        $this->assertEquals(url('/packageList'), $response->getTargetUrl());
    }
}

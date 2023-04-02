<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackAndTraceTest extends TestCase
{
    use RefreshDatabase;

    /* test */
    public function testTrackAndTraceCodeGetsOrderView()
    {
        $package = Package::factory()->create();

        $label = Label::factory()->forPackage($package)->create();

        $request = [
            'code' => $package->trackandtracecode,
        ];

        $response = $this->post('/order', $request);

        $response->assertStatus(200);
        $response->assertViewHas('package', $package);
        $response->assertViewHas('label', $label);
    }
}

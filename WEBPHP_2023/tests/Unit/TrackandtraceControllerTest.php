<?php

namespace Tests\Unit;

use App\Http\Controllers\TrackandtraceController;
use App\Models\Label;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;
use Tests\TestCase;

class TrackandtraceControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_order_view_with_package_and_label()
    {
        $package = Package::factory()->create([
            'trackandtracecode' => 'ABC123',
        ]);
        $label = Label::factory()->create([
            'packageID' => $package->id,
        ]);

        $request = Request::create('/order', 'GET', ['code' => 'ABC123']);

        $controller = new TrackandtraceController;

        $response = $controller->getOrderView($request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('trackandtrace.order', $response->getName());
        $this->assertEquals($package->id, $response->package->id);
        $this->assertEquals($label->id, $response->label->id);
    }
}

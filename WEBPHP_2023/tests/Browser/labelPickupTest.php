<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class labelPickupTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('http://127.0.0.1:8000/login')
                ->click('@loginemployee')
                ->click('@packagelist')
                ->click('@check1')
                ->click('@labelbulk')
                ->click('@back')
                ->click('@labellist')
                ->click('@check1')
                ->click('@labelbulk')
                ->click('@back')
                ->click('@pickuplist')
                ->click('@check1')
                ->click('@planpickup')
                ->type('@address', 'duskadres 1')
                ->type('@postcode', '5151ds')
                ->click('@submit')
                ->screenshot('test');

        });
    }
}

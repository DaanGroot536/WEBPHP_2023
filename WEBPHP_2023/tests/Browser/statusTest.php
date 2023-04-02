<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class statusTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser, Browser $browser2) {
            $browser
                ->visit('http://127.0.0.1:8000/login')
                ->click('@logindeliverer')
                ->click('@statuslist')
                ->click('@item1')
                ->click('@Delivered to customer')
                ->screenshot('statustest')
                ;

            $browser2
                ->visit('http://127.0.0.1:8000/login')
                ->click('@logincustomer')
                ->click('@packagelist')
                ->click('@track1')
                ->type('@stars', '1')
                ->type('@reviewtext', 'Bad service шщтйвчфытфсшйййшрйвйвщс сфьымьйщцмйи й ьсийсй с йис')
                ->click('@submit')
                ->screenshot('writereviewtest')
                ;
        });
    }
}

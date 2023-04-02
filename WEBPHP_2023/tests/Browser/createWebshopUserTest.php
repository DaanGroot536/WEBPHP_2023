<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class createWebshopUserTest extends DuskTestCase
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
                ->click('@loginwebshop')
                ->click('@userlist')
                ->click('@createuser')
                ->type('@name', 'duskwebshopuser')
                ->type('@email', 'duskwebshopuser@email.com')
                ->type('@password', 'password')
                ->select('@role', '@employee')
                ->type('@street', 'duskstreet')
                ->type('@housenumber', '1')
                ->type('@zipcode', '5151ds')
                ->type('@city', 'duskcity')
                ->click('@submit')
            ;
        });
    }
}

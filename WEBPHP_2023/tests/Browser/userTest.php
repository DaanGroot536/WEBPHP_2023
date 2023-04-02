<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class userTest extends DuskTestCase
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
                ->click('@loginadmin')
                ->click('@userlist')
                ->click('@createuser')
                ->type('@name', 'duskuser')
                ->type('@email', 'duskuser@email.com')
                ->type('@password', 'password')
                ->select('@role')
                ->type('@street', 'duskstreet')
                ->type('@housenumber', '1')
                ->type('@zipcode', '5151ds')
                ->type('@city', 'duskcity')
                ->click('@submit')
                ->visit('http://127.0.0.1:8000/dashboard')
                ->click('@userlist')
                ->click('@user3')
                ->type('@name', 'duskuserchanged')
                ->type('@email', 'duskuserchanged@email.com')
                ->type('@password', 'password')
                ->select('@role', '@customer')
                ->type('@street', 'duskstreetchanged')
                ->type('@housenumber', '1')
                ->type('@zipcode', '5151ds')
                ->type('@city', 'duskcity')
                ->click('@submit')
                ->screenshot('userchangedtest');
        });
    }
}

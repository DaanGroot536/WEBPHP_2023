<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class packageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->browse(function (Browser $first) {
            $first
                ->visit('http://127.0.0.1:8000/login')
                ->click('@loginwebshop')
                ->click('@packagelist')
                ->click('@createpackage')
                ->type('width', '20')
                ->type('length', '20')
                ->type('height', '20')
                ->type('weight', '2000')
                ->type('customerName', 'mr. dusk')
                ->type('customerEmail', 'dusk@test.com')
                ->type('customerStreet', 'teststreet')
                ->type('customerHousenumber', '1')
                ->type('customerZipcode', '5151DS')
                ->type('customerCity', 'duskcity')
                ->press('Save');
        });
    }
}

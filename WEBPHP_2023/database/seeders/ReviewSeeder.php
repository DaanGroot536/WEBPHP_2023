<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
            'username' => 'Emily Johnson',
            'amount_of_stars' => 4,
            'review_text' => 'I received my package of Sport World Running Shoes, and I was impressed with the quality and design of the shoes. The shoes were comfortable and provided excellent support during my runs. The only issue I had was with the sizing; they ran slightly small, so I would recommend sizing up.',
            'packageID' => 2,
            'delivery_service' => 'DHL',
        ]);

        Review::create([
            'username' => 'Jacob Smith',
            'amount_of_stars' => 2,
            'review_text' => 'I received my package of Sport World Exercise Equipment, and unfortunately, I was disappointed with the quality of the product. The equipment was flimsy and did not hold up well during my workouts. Additionally, the delivery was delayed, which was frustrating.',
            'packageID' => 3,
            'delivery_service' => 'PostNL',
        ]);

        Review::create([
            'username' => 'Olivia Brown',
            'amount_of_stars' => 5,
            'review_text' => 'I received my package of Sport World Fitness Tracker, and I was blown away by the features and functionality of the tracker. It was easy to set up and use, and the data tracking was accurate and helpful in reaching my fitness goals. The delivery was quick and efficient, and the packaging was impressive.',
            'packageID' => 4,
            'delivery_service' => 'DPD',
        ]);

        Review::create([
            'username' => 'Ethan Davis',
            'amount_of_stars' => 3,
            'review_text' => 'I received my package of Sport World Yoga Mat, and while the quality of the mat was good, the delivery was delayed and caused inconvenience. Additionally, the packaging was damaged upon arrival, but thankfully, the mat itself was not affected.',
            'packageID' => 5,
            'delivery_service' => 'PostNL',
        ]);

        Review::create([
            'username' => 'Ava Wilson',
            'amount_of_stars' => 5,
            'review_text' => 'I received my package of Sport World Sports Drink, and I was impressed with the taste and effectiveness of the drink. It provided excellent hydration during my workouts and was a refreshing alternative to water. The delivery was fast and efficient, and the packaging was well-sealed to prevent leaks.',
            'packageID' => 6,
            'delivery_service' => 'DHL',
        ]);
    }
}

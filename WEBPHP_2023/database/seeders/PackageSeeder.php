<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run()
    {
        Package::create([
            'webshopName' => 'Cool Gadgets',
            'webshopStreet' => 'Piet Heinstraat',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '1234AB',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Jan van Scorelstraat',
            'customerHousenumber' => 23,
            'customerZipcode' => '5678CD',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '50x40x30',
            'weight' => '1000',
        ]);
        
        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '2345EF',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Hoflaan',
            'customerHousenumber' => 12,
            'customerZipcode' => '6789GH',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '80x60x40',
            'weight' => '1500',
        ]);
        
        Package::create([
            'webshopName' => 'Fashion Trendy',
            'webshopStreet' => 'Kruisstraat',
            'webshopHousenumber' => 15,
            'webshopZipcode' => '3456IJ',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Prins Hendrikstraat',
            'customerHousenumber' => 8,
            'customerZipcode' => '7890KL',
            'customerCity' => 'Amersfoort',
            'status' => 'submitted',
            'dimensions' => '100x80x60',
            'weight' => '2500',
        ]);
        
        Package::create([
            'webshopName' => 'Tech Smart',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 44,
            'webshopZipcode' => '1234AB',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Oudezijds Achterburgwal',
            'customerHousenumber' => 23,
            'customerZipcode' => '5678CD',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '50x40x30',
            'weight' => '1000',
        ]);
        
        Package::create([
            'webshopName' => 'Outdoors',
            'webshopStreet' => 'Spuistraat',
            'webshopHousenumber' => 92,
            'webshopZipcode' => '2345EF',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Nieuwezijds Voorburgwal',
            'customerHousenumber' => 12,
            'customerZipcode' => '6789GH',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '80x60x40',
            'weight' => '1500',
        ]);
        
        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '3456IJ',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Binnenhof',
            'customerHousenumber' => 8,
            'customerZipcode' => '7890KL',
            'customerCity' => 'Amersfoort',
            'status' => 'submitted',
            'dimensions' => '100x80x60',
            'weight' => '2500',
        ]);
        
        Package::create([
            'webshopName' => 'Fashionista',
            'webshopStreet' => 'Van Baerlestraat',
            'webshopHousenumber' => 26,
            'webshopZipcode' => '2345FG',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Stationsstraat',
            'customerHousenumber' => 5,
            'customerZipcode' => '6789HI',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '60x40x20',
            'weight' => '2000',
        ]);
        
        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Hoogstraat',
            'webshopHousenumber' => 35,
            'webshopZipcode' => '3456JK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Oudegracht',
            'customerHousenumber' => 14,
            'customerZipcode' => '7890LM',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '70x50x30',
            'weight' => '1200',
        ]);
        
        Package::create([
            'webshopName' => 'Home Decor',
            'webshopStreet' => 'Rozengracht',
            'webshopHousenumber' => 67,
            'webshopZipcode' => '4567KL',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Maliebaan',
            'customerHousenumber' => 2,
            'customerZipcode' => '8901MN',
            'customerCity' => 'Amersfoort',
            'status' => 'submitted',
            'dimensions' => '90x70x50',
            'weight' => '2900',
        ]);
        
        Package::create([
            'webshopName' => 'Tech Hub',
            'webshopStreet' => 'Westerstraat',
            'webshopHousenumber' => 12,
            'webshopZipcode' => '1234AB',
            'webshopCity' => 'Haarlem',
            'customerStreet' => 'Keizersgracht',
            'customerHousenumber' => 88,
            'customerZipcode' => '5678CD',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '50x50x50',
            'weight' => '1000',
        ]);
        
        Package::create([
            'webshopName' => 'Green House',
            'webshopStreet' => 'Singel',
            'webshopHousenumber' => 15,
            'webshopZipcode' => '2345EF',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Wagenstraat',
            'customerHousenumber' => 10,
            'customerZipcode' => '6789GH',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '40x30x20',
            'weight' => '2500',
        ]);
        
        Package::create([
            'webshopName' => 'Bookshop',
            'webshopStreet' => 'Grote Markt',
            'webshopHousenumber' => 3,
            'webshopZipcode' => '3456LM',
            'webshopCity' => 'Den Haag',
            'customerStreet' => 'Zadelstraat',
            'customerHousenumber' => 25,
            'customerZipcode' => '7890IJ',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '80x60x40',
            'weight' => '2000',
        ]);
        
    }
}

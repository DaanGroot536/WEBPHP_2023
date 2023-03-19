<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run()
    {
        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Kerkstraat',
            'customerHousenumber' => 10,
            'customerZipcode' => '4867GS',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '40x70x30',
            'weight' => '1500',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Zijlstraat',
            'customerHousenumber' => 8,
            'customerZipcode' => '7655YU',
            'customerCity' => 'Haarlem',
            'status' => 'submitted',
            'dimensions' => '20x90x20',
            'weight' => '1800',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Kalverstraat',
            'customerHousenumber' => 14,
            'customerZipcode' => '1615CH',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '20x10x20',
            'weight' => '300',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Keizersgracht',
            'customerHousenumber' => 44,
            'customerZipcode' => '5456HK',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '80x60x40',
            'weight' => '1200',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Grote Marktstraat',
            'customerHousenumber' => 20,
            'customerZipcode' => '4798VB',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '30x20x60',
            'weight' => '900',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Prins Hendrikstraat',
            'customerHousenumber' => 8,
            'customerZipcode' => '7890KL',
            'customerCity' => 'Amersfoort',
            'status' => 'submitted',
            'dimensions' => '100x80x60',
            'weight' => '2500',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Dijkweg',
            'customerHousenumber' => 23,
            'customerZipcode' => '4567LM',
            'customerCity' => 'Hoek van Holland',
            'status' => 'submitted',
            'dimensions' => '90x60x50',
            'weight' => '1800',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Goudkade',
            'customerHousenumber' => 10,
            'customerZipcode' => '6789NO',
            'customerCity' => 'Gouda',
            'status' => 'submitted',
            'dimensions' => '120x80x40',
            'weight' => '3000',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Dennenlaan',
            'customerHousenumber' => 21,
            'customerZipcode' => '5678PQ',
            'customerCity' => 'Nuenen',
            'status' => 'submitted',
            'dimensions' => '60x60x60',
            'weight' => '1400',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Havenkade',
            'customerHousenumber' => 12,
            'customerZipcode' => '7890RS',
            'customerCity' => 'Kampen',
            'status' => 'submitted',
            'dimensions' => '70x50x40',
            'weight' => '900',
        ]);

        Package::create([
            'webshopName' => 'Sport World',
            'webshopStreet' => 'Marie Heinekenplein',
            'webshopHousenumber' => 5,
            'webshopZipcode' => '4551VK',
            'webshopCity' => 'Rotterdam',
            'customerStreet' => 'Oudezijds Achterburgwal',
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
            'webshopZipcode' => '4551VK',
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
            'webshopZipcode' => '7994CS',
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
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Stationsstraat',
            'customerHousenumber' => 5,
            'customerZipcode' => '6789HI',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '60x40x20',
            'weight' => '2000',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Oudegracht',
            'customerHousenumber' => 14,
            'customerZipcode' => '7890LM',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '70x50x30',
            'weight' => '1200',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
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
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Keizersgracht',
            'customerHousenumber' => 88,
            'customerZipcode' => '5678CD',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '50x50x50',
            'weight' => '1000',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Wagenstraat',
            'customerHousenumber' => 10,
            'customerZipcode' => '6789GH',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '40x30x20',
            'weight' => '2500',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Zadelstraat',
            'customerHousenumber' => 25,
            'customerZipcode' => '7890IJ',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '80x60x40',
            'weight' => '2000',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Willemsparkweg',
            'customerHousenumber' => 23,
            'customerZipcode' => '4512BC',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '120x80x60',
            'weight' => '1000',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Kerkstraat',
            'customerHousenumber' => 45,
            'customerZipcode' => '5678CD',
            'customerCity' => 'Utrecht',
            'status' => 'submitted',
            'dimensions' => '80x60x40',
            'weight' => '1500',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Coolsingel',
            'customerHousenumber' => 30,
            'customerZipcode' => '9012EF',
            'customerCity' => 'Rotterdam',
            'status' => 'submitted',
            'dimensions' => '120x100x80',
            'weight' => '2500',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Nieuwe Binnenweg',
            'customerHousenumber' => 60,
            'customerZipcode' => '3456GH',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '100x80x60',
            'weight' => '2000',
        ]);

        Package::create([
            'webshopName' => 'Books Galore',
            'webshopStreet' => 'Lange Poten',
            'webshopHousenumber' => 11,
            'webshopZipcode' => '7994CS',
            'webshopCity' => 'Groningen',
            'customerStreet' => 'Vismarkt',
            'customerHousenumber' => 15,
            'customerZipcode' => '6789KL',
            'customerCity' => 'Groningen',
            'status' => 'submitted',
            'dimensions' => '120x80x40',
            'weight' => '1700',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Beatrixlaan',
            'customerHousenumber' => 12,
            'customerZipcode' => '5678MN',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '60x80x100',
            'weight' => '1000',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Laan van Westenenk',
            'customerHousenumber' => 25,
            'customerZipcode' => '3456RS',
            'customerCity' => 'Apeldoorn',
            'status' => 'submitted',
            'dimensions' => '80x60x120',
            'weight' => '1500',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Oude Kijk in Het Jatstraat',
            'customerHousenumber' => 21,
            'customerZipcode' => '8910KL',
            'customerCity' => 'Groningen',
            'status' => 'submitted',
            'dimensions' => '100x80x80',
            'weight' => '2000',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Grote Marktstraat',
            'customerHousenumber' => 17,
            'customerZipcode' => '7994CS',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '80x100x60',
            'weight' => '2300',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Plein 1945',
            'customerHousenumber' => 6,
            'customerZipcode' => '4567FG',
            'customerCity' => 'Eindhoven',
            'status' => 'submitted',
            'dimensions' => '100x100x100',
            'weight' => '2500',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Zandvoorterweg',
            'customerHousenumber' => 7,
            'customerZipcode' => '2106LC',
            'customerCity' => 'Heemstede',
            'status' => 'submitted',
            'dimensions' => '120x80x40',
            'weight' => '800',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Rijswijkstraat',
            'customerHousenumber' => 141,
            'customerZipcode' => '1062EC',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '80x60x60',
            'weight' => '1500',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'De Lairessestraat',
            'customerHousenumber' => 157,
            'customerZipcode' => '1075HH',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '100x60x80',
            'weight' => '1100',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Korte Vijverberg',
            'customerHousenumber' => 4,
            'customerZipcode' => '2513AB',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '120x100x60',
            'weight' => '2200',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Lange Voorhout',
            'customerHousenumber' => 34,
            'customerZipcode' => '2514EG',
            'customerCity' => 'Den Haag',
            'status' => 'submitted',
            'dimensions' => '80x80x80',
            'weight' => '2000',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Oudegracht',
            'customerHousenumber' => 25,
            'customerZipcode' => '3456IJ',
            'customerCity' => 'Groningen',
            'status' => 'submitted',
            'dimensions' => '120x80x60',
            'weight' => '1900',
        ]);

        Package::create([
            'webshopName' => 'Electroshop',
            'webshopStreet' => 'Keizersgracht',
            'webshopHousenumber' => 10,
            'webshopZipcode' => '3842LM',
            'webshopCity' => 'Amsterdam',
            'customerStreet' => 'Lange Poten',
            'customerHousenumber' => 10,
            'customerZipcode' => '6822FV',
            'customerCity' => 'Amsterdam',
            'status' => 'submitted',
            'dimensions' => '90x70x50',
            'weight' => '2300',
        ]);
    }
}

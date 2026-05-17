<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            // Sports
            ['brand' => 'Toyota',     'model' => 'GR Supra',        'type' => 'Sports',      'image_url' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800'],
            ['brand' => 'Nissan',     'model' => 'GT-R R35',        'type' => 'Sports',      'image_url' => 'https://images.unsplash.com/photo-1632245889029-e406faaa34cd?w=800'],
            ['brand' => 'Porsche',    'model' => '911 Carrera',     'type' => 'Sports',      'image_url' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800'],
            ['brand' => 'Ferrari',    'model' => 'F8 Tributo',      'type' => 'Sports',      'image_url' => 'https://images.unsplash.com/photo-1592198084033-aade902d1aae?w=800'],
            ['brand' => 'Lamborghini','model' => 'Huracan Evo',     'type' => 'Sports',      'image_url' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800'],

            // Sedan
            ['brand' => 'BMW',        'model' => '3 Series',        'type' => 'Sedan',       'image_url' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800'],
            ['brand' => 'Mercedes',   'model' => 'C-Class',         'type' => 'Sedan',       'image_url' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=800'],
            ['brand' => 'Audi',       'model' => 'A4',              'type' => 'Sedan',       'image_url' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800'],
            ['brand' => 'Honda',      'model' => 'Civic',           'type' => 'Sedan',       'image_url' => 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?w=800'],
            ['brand' => 'Toyota',     'model' => 'Camry',           'type' => 'Sedan',       'image_url' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800'],
            ['brand' => 'Hyundai',    'model' => 'Elantra',         'type' => 'Sedan',       'image_url' => 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=800'],

            // SUV
            ['brand' => 'Toyota',     'model' => 'Land Cruiser',    'type' => 'SUV',         'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800'],
            ['brand' => 'BMW',        'model' => 'X5',              'type' => 'SUV',         'image_url' => 'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?w=800'],
            ['brand' => 'Mercedes',   'model' => 'GLE',             'type' => 'SUV',         'image_url' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=800'],
            ['brand' => 'Ford',       'model' => 'Explorer',        'type' => 'SUV',         'image_url' => 'https://images.unsplash.com/photo-1551830820-330a71b99659?w=800'],
            ['brand' => 'Jeep',       'model' => 'Wrangler',        'type' => 'SUV',         'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800'],
            ['brand' => 'Porsche',    'model' => 'Cayenne',         'type' => 'SUV',         'image_url' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800'],

            // Hatchback
            ['brand' => 'Volkswagen', 'model' => 'Golf GTI',        'type' => 'Hatchback',   'image_url' => 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=800'],
            ['brand' => 'Honda',      'model' => 'Civic Type R',    'type' => 'Hatchback',   'image_url' => 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?w=800'],
            ['brand' => 'Ford',       'model' => 'Focus ST',        'type' => 'Hatchback',   'image_url' => 'https://images.unsplash.com/photo-1551830820-330a71b99659?w=800'],
            ['brand' => 'Hyundai',    'model' => 'i30 N',           'type' => 'Hatchback',   'image_url' => 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=800'],
            ['brand' => 'Toyota',     'model' => 'GR Yaris',        'type' => 'Hatchback',   'image_url' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800'],

            // Coupe
            ['brand' => 'Ford',       'model' => 'Mustang GT',      'type' => 'Coupe',       'image_url' => 'https://images.unsplash.com/photo-1584345604476-8ec5e12e42dd?w=800'],
            ['brand' => 'Chevrolet',  'model' => 'Camaro SS',       'type' => 'Coupe',       'image_url' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800'],
            ['brand' => 'BMW',        'model' => '4 Series',        'type' => 'Coupe',       'image_url' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800'],
            ['brand' => 'Audi',       'model' => 'TT RS',           'type' => 'Coupe',       'image_url' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800'],

            // Convertible
            ['brand' => 'Mazda',      'model' => 'MX-5 Miata',     'type' => 'Convertible', 'image_url' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800'],
            ['brand' => 'Porsche',    'model' => 'Boxster',         'type' => 'Convertible', 'image_url' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800'],
            ['brand' => 'BMW',        'model' => 'Z4',              'type' => 'Convertible', 'image_url' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800'],

            // Truck
            ['brand' => 'Ford',       'model' => 'F-150 Raptor',   'type' => 'Truck',       'image_url' => 'https://images.unsplash.com/photo-1551830820-330a71b99659?w=800'],
            ['brand' => 'Toyota',     'model' => 'Hilux GR Sport', 'type' => 'Truck',       'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800'],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }

        $this->command->info('30 cars seeded successfully.');
    }
}

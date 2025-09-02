<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusinessSetting::create([
            'business_name' => 'Gstandard',
            'business_email' => 'info@mybusiness.com',
            'business_phone' => '123-456-7890',
            'business_address' => '123 Business St, Business City, BC 12345',
            'business_logo' => 'default_logo.png',
            'business_country'=> 'Country Name',
            'business_city' => 'City Name',
            'business_other_details' => 'Some other details about the business'
        ]);
    }
}

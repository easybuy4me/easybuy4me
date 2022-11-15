<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'vendor_payment_amount'=>'2500',
            'title'=>'easybuy4me',
            'flutterwave_public_key'=>'FLWPUBK_TEST-9573fbeabbba4ddb33259c4fd84d0b0d-X',
            'flutterwave_secret_key'=>''
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_settings = array(
            array('id' => '1','key' => 'paypal_status','value' => 'active','created_at' => '2024-05-29 15:56:54','updated_at' => '2024-05-29 15:56:54'),
            array('id' => '2','key' => 'paypal_mode','value' => 'sandbox','created_at' => '2024-05-29 15:56:54','updated_at' => '2024-05-29 15:56:54'),
            array('id' => '3','key' => 'paypal_country','value' => 'US','created_at' => '2024-05-29 15:56:54','updated_at' => '2024-05-29 15:56:54'),
            array('id' => '4','key' => 'paypal_currency','value' => 'USD','created_at' => '2024-05-29 15:56:54','updated_at' => '2024-05-29 15:56:54'),
            array('id' => '5','key' => 'paypal_currency_rate','value' => '1','created_at' => '2024-05-29 15:56:54','updated_at' => '2024-07-09 01:23:15'),
            array('id' => '6','key' => 'paypal_client_id','value' => 'AcPUPWvVNh1q3rPUn4ecFUqN9xMgLtzKAfAsoptAyvlJv2C4MP5qYohR3UJWW4X5NA8ODRvvqimQI7Od','created_at' => '2024-05-29 15:56:54','updated_at' => '2024-07-09 01:23:15'),
            array('id' => '7','key' => 'paypal_secret_key','value' => 'EHbPQWaYNNxamhmukS5OOu4lxTghUqHaUbgGMc3o6qA6Vxg27ipMhkLUThoZ--BCnNj5lSIRO3H3gk8b','created_at' => '2024-05-29 15:56:54','updated_at' => '2024-07-09 01:23:15'),
            array('id' => '8','key' => 'paypal_app_key','value' => 'app_key','created_at' => '2024-05-29 15:56:54','updated_at' => '2024-05-29 15:56:54'),
            array('id' => '9','key' => 'stripe_status','value' => 'active','created_at' => '2024-07-30 11:45:44','updated_at' => '2024-07-30 11:45:44'),
            array('id' => '10','key' => 'stripe_country','value' => 'US','created_at' => '2024-07-30 11:45:44','updated_at' => '2024-07-30 11:48:16'),
            array('id' => '11','key' => 'stripe_currency','value' => 'USD','created_at' => '2024-07-30 11:45:44','updated_at' => '2024-07-30 11:48:16'),
            array('id' => '12','key' => 'stripe_currency_rate','value' => '1','created_at' => '2024-07-30 11:45:44','updated_at' => '2024-07-30 11:45:44'),
            array('id' => '13','key' => 'stripe_secret_key','value' => 'sk_test_51PiALyCjORc2jNX80FCfMoR1fCqp86FG9XKMouGhgDXFqDyCfi1PsW9uvsZREAvmXdNSMUtq9lKOETaojhuQ9LC100cPogiVuZ','created_at' => '2024-07-30 11:45:44','updated_at' => '2024-07-30 11:48:16'),
            array('id' => '14','key' => 'stripe_key','value' => 'pk_test_51PiALyCjORc2jNX8Q3AckkieMAegF5wMRrIirBGxRJ8MdJYh9aIxtDLdGe0tskC4wJtX6tNP4JBBZJF150kIRiff00c8Busnxz','created_at' => '2024-07-30 11:45:44','updated_at' => '2024-07-30 11:48:16'),
            array('id' => '15','key' => 'razorpay_status','value' => 'active','created_at' => '2024-07-30 17:18:24','updated_at' => '2024-07-30 17:18:24'),
            array('id' => '16','key' => 'razorpay_country','value' => 'IN','created_at' => '2024-07-30 17:18:24','updated_at' => '2024-07-30 17:18:24'),
            array('id' => '17','key' => 'razorpay_currency','value' => 'INR','created_at' => '2024-07-30 17:18:24','updated_at' => '2024-07-30 17:18:24'),
            array('id' => '18','key' => 'razorpay_currency_rate','value' => '83.1','created_at' => '2024-07-30 17:18:24','updated_at' => '2024-07-30 17:21:22'),
            array('id' => '19','key' => 'razorpay_secret_key','value' => 'zSBmNMorJrirOrnDrbOd1ALO','created_at' => '2024-07-30 17:18:24','updated_at' => '2024-07-31 20:37:19'),
            array('id' => '20','key' => 'razorpay_key','value' => 'rzp_test_K7CipNQYyyMPiS','created_at' => '2024-07-30 17:18:24','updated_at' => '2024-07-31 20:37:19')
          );

          \DB::table('payment_settings')->insert($payment_settings);
    }
}

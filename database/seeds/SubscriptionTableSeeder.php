<?php

use Illuminate\Database\Seeder;
use App\Subscription;
class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        $subscription = new Subscription();
        $subscription->name = 'basic';
        $subscription->min_labels = 0;
        $subscription->max_labels = 1000;
        $subscription->save();

        
        $subscription = new Subscription();
        $subscription->name = 'intermediate';
        $subscription->min_labels = 1001;
        $subscription->max_labels = 5000;
        $subscription->save();

        $subscription = new Subscription();
        $subscription->name = 'elite';
        $subscription->min_labels = 5001;
        $subscription->max_labels = 20000;
        $subscription->save();

    }
}

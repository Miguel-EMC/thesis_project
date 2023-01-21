<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:expired_subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =  'Check for expired subscriptions and deactivate them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredSubscriptions = Subscription::where('status', 'active')->where('end_date', '<', Carbon::now())->get();
        Product::where('featured', true)->get();

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->update(['status' => 'expired']);
            $subscription->product()->update(['featured' => false]);
        }
    }
}

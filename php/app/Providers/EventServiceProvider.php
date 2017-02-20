<?php
namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */


    protected $listen = [
        'auth.login' => [
            'App\Listeners\AuthLoginListener',
        ],
        'App\Events\Action' => [
            'App\Listeners\ActionListener',
        ],
        SocialiteWasCalled::class => [
            \SocialiteProviders\Weixin\WeixinExtendSocialite::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

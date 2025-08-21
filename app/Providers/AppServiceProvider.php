<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $platform = \DB::getDoctrineConnection()->getDatabasePlatform();
        // $platform->registerDoctrineTypeMapping('enum', 'string');
        
        // // Register custom Doctrine type
        // if (!Type::hasType('enum')) {
        //     Type::addType('enum', 'App\Providers\EnumType');
        // }
        //Schema::useNativeSchemaOperationsIfPossible();
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use Domain\Blogging\Projectors\PostProjector;
use Domain\Blogging\Reactors\PostReactor;
use Illuminate\Support\ServiceProvider;
use Spatie\EventSourcing\Facades\Projectionist;

class EventSourcingProvider extends ServiceProvider {
    
    public function register(): void {
        /**
         * Registering the Projectors
         */

        Projectionist::addProjectors(
            projectors: [
                PostProjector::class
            ]
        );

        /**
         * Registering the Reactors
         */

        Projectionist::addReactors(
            reactors: [
                PostReactor::class
            ]
        );
    }

    public function boot(): void {
        //
    }
}

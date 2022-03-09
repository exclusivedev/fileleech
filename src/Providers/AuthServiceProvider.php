<?php

namespace ExclusiveDev\FileLeech\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use ExclusiveDev\FileLeech\Policies\AttachmentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::resource('attachments', AttachmentPolicy::class, [
            'delete' => 'delete',            
            'store' => 'store'
        ]);
    }
}
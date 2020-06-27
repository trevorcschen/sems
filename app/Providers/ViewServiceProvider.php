<?php

namespace App\Providers;

use App\Community;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('includes.asidemenu', function($view)
        {
            if(Auth::user()->roles->first->name->name == 'community-admin')
            {
                $authID = Auth::user()->id;
                $communities = Community::where('user_id', $authID)->get();
                $view->with('communities', $communities);

            }
//            $authID = Auth::user()->id;
//            $communities = Community::where('user_id', $authID)->get();
//            $view->with('authAPIKEY', Auth::user()->student_id);
        });
    }
}

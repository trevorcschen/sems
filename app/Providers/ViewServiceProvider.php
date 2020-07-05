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
            } elseif (Auth::user()->roles->first->name->name == 'student')
            {
                $authID = Auth::user()->id;
                $communities = Auth::user()->communities;
                $view->with('communities', $communities);
            }
        });

        View::composer('includes.globalconfig', function($view)
        {
            $authID = Auth::user()->id;
            if(Auth::user()->roles->first->name->name == 'student')
            {
                $students = \App\User::where('id', $authID)->first();
                $channels = array_map(function($string)
                {
                    return str_replace(" ", "-", 'community-channel_'.strtolower($string));
                }, array_column(json_decode($students->communities, true), 'name'));
            }
            else if(Auth::user()->roles->first->name->name == 'community-admin')
            {
                        $communities = \App\Community::where('user_id', $authID)->get();
                        $channels = array_map(function($string)
                        {
                            return str_replace(" ", "-", 'community-channel-admin_'.strtolower($string));
                        }, array_column(json_decode($communities, true), 'name'));
            }

            $view->with('authAPIKEY', Auth::user()->student_id)->with('student_channels', $channels??[]);
        });
    }
}

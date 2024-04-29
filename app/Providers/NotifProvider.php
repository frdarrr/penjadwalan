<?php

namespace App\Providers;

use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NotifProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() : void
    {
        View::composer(
            '*',
            function ($view) {
                $user = Auth::user();
                $jadwal = null;
                if ($user) {
                    $dosen = Dosen::where('user_id', '=', $user->id)->first();
                    if ($dosen) {
                        $jadwal = Jadwal::where('dosen_id', '=', $dosen->id)->where('hari', '=', now()->dayName)->get();
                        if ($jadwal->isEmpty()) {
                            $jadwal = null;
                        }
                    }
                }
                $view->with('notif',$jadwal);
            }

        );
    }
}

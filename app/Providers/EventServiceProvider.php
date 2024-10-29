<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */

    protected $user_id;


    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            $this->user_id = Auth::user()->id;
            $user = Auth::user();
            $permissionNames = $user->getPermissionsViaRoles();

            $modulos = DB::table('modulos_enlace')->whereIn('enlace_permiso', $permissionNames->pluck('name')->toArray())->get()->groupBy('modulo_nombre');

            $items = $modulos->map(function ($page) {
                $submenu = $page->map(function ($page) {
                    $parametros = str_replace('user_id', strval($this->user_id), $page->enlace_parametro);
                    return [
                        'text' => $page->enlace_titulo,
                        'route' => [$page->enlace_enlace, ['enlace', $parametros]],
                        'classes' => 'text-yellow',
                    ];
                });
                //dd($submenu->toArray());

                $menu = [
                    'text' => $page[0]->modulo_nombre,
                    'icon' => $page[0]->modulo_icono,
                    'submenu' => $submenu->toArray(),
                    'classes' => 'd-flex text-end',
                ];
                return $menu;
            });
            //dd(array_values($items->toArray()));
            $event->menu->add(...array_values($items->toArray()));
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

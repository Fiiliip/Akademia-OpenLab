<?php namespace App\Arrival;

use Backend;
use System\Classes\PluginBase;

use Event;
use Log;

use RainLab\User\Models\User;

/**
 * Arrival Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Arrival',
            'description' => 'No description provided yet...',
            'author'      => 'App',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function($model) {
            $model->hasMany['arrivals'] = ['App\Arrival\Models\Arrival'];
        });

        Event::listen('app.arrival.show', function($user_id) {
            $user = User::find($user_id);
            Log::info('User ' . $user->name . ' has requested their arrival information.');
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'App\Arrival\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'app.arrival.some_permission' => [
                'tab' => 'Arrival',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'arrival' => [
                'label'       => 'Arrival',
                'url'         => Backend::url('app/arrival/arrivals'),
                'icon'        => 'icon-leaf',
                'permissions' => ['app.arrival.*'],
                'order'       => 500,
            ],
        ];
    }
}

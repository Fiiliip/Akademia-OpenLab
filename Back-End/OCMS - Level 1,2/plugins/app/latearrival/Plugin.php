<?php namespace App\LateArrival;

use Backend;
use System\Classes\PluginBase;

use Carbon\Carbon;
use App\Arrival\Models\Arrival;

/**
 * LateArrival Plugin Information File
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
            'name'        => 'LateArrival',
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
        Arrival::extend(function($model) {
            $model->bindEvent('model.afterCreate', function() use ($model) {
                if ($model->created_at->format('H:i') > '08:00') {
                    $model->is_late = true;
                    $model->save();
                }
            });
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
            'App\LateArrival\Components\MyComponent' => 'myComponent',
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
            'app.latearrival.some_permission' => [
                'tab' => 'LateArrival',
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
        return []; // Remove this line to activate

        return [
            'latearrival' => [
                'label'       => 'LateArrival',
                'url'         => Backend::url('app/latearrival/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['app.latearrival.*'],
                'order'       => 500,
            ],
        ];
    }
}

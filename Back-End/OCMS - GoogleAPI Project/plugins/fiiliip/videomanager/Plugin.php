<?php namespace Fiiliip\VideoManager;

use Backend;
use System\Classes\PluginBase;

/**
 * VideoManager Plugin Information File
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
            'name'        => 'VideoManager',
            'description' => 'No description provided yet...',
            'author'      => 'Fiiliip',
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
            'Fiiliip\VideoManager\Components\MyComponent' => 'myComponent',
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
            'fiiliip.videomanager.some_permission' => [
                'tab' => 'VideoManager',
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
            'videomanager' => [
                'label'       => 'VideoManager',
                'url'         => Backend::url('fiiliip/videomanager/videos'),
                'icon'        => 'icon-leaf',
                'permissions' => ['fiiliip.videomanager.*'],
                'order'       => 500,
            ],
        ];
    }
}

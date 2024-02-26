<?php namespace TeamGrid\Tasks;

use Backend;
use System\Classes\PluginBase;

use RainLab\User\Models\User;

/**
 * Tasks Plugin Information File
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
            'name'        => 'Tasks',
            'description' => 'No description provided yet...',
            'author'      => 'TeamGrid',
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
            $model->hasMany['tasks'] = ['TeamGrid\Tasks\Models\Task'];
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
            'TeamGrid\Tasks\Components\MyComponent' => 'myComponent',
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
            'teamgrid.tasks.some_permission' => [
                'tab' => 'Tasks',
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
            'tasks' => [
                'label'       => 'Tasks',
                'url'         => Backend::url('teamgrid/tasks/tasks'),
                'icon'        => 'icon-leaf',
                'permissions' => ['teamgrid.tasks.*'],
                'order'       => 500,
            ],
        ];
    }
}

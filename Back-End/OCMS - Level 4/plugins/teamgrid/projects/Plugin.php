<?php namespace TeamGrid\Projects;

use Backend;
use System\Classes\PluginBase;

use RainLab\User\Models\User;

/**
 * Projects Plugin Information File
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
            'name'        => 'Projects',
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
            $model->hasMany['projects'] = ['TeamGrid\Projects\Models\Project'];
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
            'TeamGrid\Projects\Components\MyComponent' => 'myComponent',
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
            'teamgrid.projects.some_permission' => [
                'tab' => 'Projects',
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
            'projects' => [
                'label'       => 'Projects',
                'url'         => Backend::url('teamgrid/projects/projects'),
                'icon'        => 'icon-leaf',
                'permissions' => ['teamgrid.projects.*'],
                'order'       => 500,
            ],
        ];
    }
}

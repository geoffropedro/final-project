<?php namespace GeoffMillar\Theme\Subscribers;

use GeoffMillar\Admin\Components\Menu;

class ThemeEventHandler {

    public function onRenderMenu(Menu $menu)
    {
        //Add to main menu
        $menu['Themes'] = [
        'route'=>"admin/themes",
        'icon'=>'fa fa-eye'
        ];
    }

    public function subscribe($events)
    {
        $events->listen(
            'admin.renderMenu',
            get_class($this) . '@onRenderMenu'
            );
    }
}
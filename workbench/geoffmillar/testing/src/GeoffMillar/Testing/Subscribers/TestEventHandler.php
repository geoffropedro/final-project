<?php namespace GeoffMillar\Testing\Subscribers;

use GeoffMillar\Admin\Components\Menu;

class TestingEventHandler {

    public function onRenderMenu(Menu $menu)
    {
 
        $menu['testing'] = [
        'route'=>"admin/testing",
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
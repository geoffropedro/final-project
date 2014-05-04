<?php namespace GeoffMillar\Admin\Subscribers;

use GeoffMillar\Admin\Components\Menu;

class PageEventHandler {

    //Add to content dropdown menu
    public function onRenderMenu(Menu $menu)
    {
        $menu['Pages'] = route('admin.pages.index');
    }
    
    public function subscribe($events)
    {
        $events->listen(
            'admin.renderContentMenu',
            get_class($this) . '@onRenderMenu'
        );
    }

}
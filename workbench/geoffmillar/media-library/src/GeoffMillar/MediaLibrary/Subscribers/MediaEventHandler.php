<?php namespace GeoffMillar\MediaLibrary\Subscribers;

use GeoffMillar\Admin\Components\Menu;

class MediaEventHandler {

    public function onRenderMenu(Menu $menu)
    {
        $menu['Media'] = route('admin.media.index');
    }

    public function subscribe($events)
    {
        $events->listen(
            'admin.renderContentMenu',
            get_class($this) . '@onRenderMenu'
        );
    }
}
<?php namespace GeoffMillar\ContentBlock\Subscribers;

use GeoffMillar\Admin\Components\Menu;

class BlockEventHandler {

    public function onRenderMenu(Menu $menu)
    {
        $menu['Blocks'] = route('admin.blocks.index');
    }

    public function subscribe($events)
    {
        $events->listen(
            'admin.renderContentMenu',
            get_class($this) . '@onRenderMenu'
        );
    }
}
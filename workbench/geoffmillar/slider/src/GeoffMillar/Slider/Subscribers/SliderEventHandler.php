<?php namespace GeoffMillar\Slider\Subscribers;

use GeoffMillar\Admin\Components\Menu;

class SliderEventHandler {

    //Add to link to content menu
    public function onRenderMenu(Menu $menu)
    {
        $menu['Slider'] = route('admin.slider.index');
    }

    public function subscribe($events)
    {
        $events->listen(
            'admin.renderContentMenu',
            get_class($this) . '@onRenderMenu'
        );
    }
}
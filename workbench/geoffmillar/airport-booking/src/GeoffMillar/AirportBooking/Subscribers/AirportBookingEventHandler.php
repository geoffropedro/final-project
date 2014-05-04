<?php namespace GeoffMillar\AirportBooking\Subscribers;

use GeoffMillar\Admin\Components\Menu;

class AirportBookingEventHandler {

    public function onRenderMenu(Menu $menu)
    {
        //Add to main menu
        $menu['Bookings'] = [
        'route'=>"admin/bookings/schedule",
        'icon'=>'fa fa-calendar'
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
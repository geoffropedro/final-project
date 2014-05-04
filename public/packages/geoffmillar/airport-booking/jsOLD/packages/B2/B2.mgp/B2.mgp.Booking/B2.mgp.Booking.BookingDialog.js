B2.Booking.BookingDialog = Ext.extend( Ext.Window, {
	
	itemPanel: null,
	title: 'Booking Details',
	itemId: 0,
	layout: 'fit',
	width: 800,
	height: 480,
	resizable: false,
	modal: true,
	
	initComponent: function()
	{
		this.itemPanel = new B2.Booking.BookingPanel({
			bookingId: this.itemId,
			title: ''
		});
		
		this.itemPanel.on( 'saved', function() {
			this.close();
		}, this );
		
		Ext.apply( this, {
			items: [
				this.itemPanel
			],
			buttons: [
				{
					text: 'Save',
					iconCls: 'accepticon',
					handler: function()
					{
						this.itemPanel.saveBooking();
					},
					scope: this
				},
				{
					text: 'Cancel',
					iconCls: 'cancelicon',
					handler: function() {
						this.close();
					},
					scope: this
				}
			]
		});
		
		B2.Booking.BookingDialog.superclass.initComponent.call( this );
	},
	
	loadBooking: function( bookingId )
	{
		this.bookingId = bookingId;
		this.itemPanel.loadBooking( bookingId );
	}
	
});
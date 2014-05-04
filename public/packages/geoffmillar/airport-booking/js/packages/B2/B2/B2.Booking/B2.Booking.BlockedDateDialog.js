B2.Booking.BlockedDateDialog = Ext.extend( Ext.Window, {
	
	itemPanel: null,
	title: 'Blocked Date Details',
	itemId: 0,
	layout: 'fit',
	width: 300,
	height: 150,
	resizable: false,
	modal: true,
	
	initComponent: function()
	{
		this.itemPanel = new B2.Booking.BlockedDatePanel({
			blockedDateId: this.itemId,
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
						this.itemPanel.saveBlockedDate();
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
		
		B2.Booking.BlockedDateDialog.superclass.initComponent.call( this );
	},
	
	loadBlockedDate: function( blockedDateId )
	{
		this.blockedDateId = blockedDateId;
		this.itemPanel.loadBlockedDate( blockedDateId );
	}
	
});
B2.Booking.BlockedDatePanel = Ext.extend( Ext.form.FormPanel, {

	title: 'Blocked Date Details',
	bookingId: 0,
	width: 300,
	height: 150,
	frame: true,
	border: true,
	
	initComponent: function()
	{
		this.addEvents({
			'saved': true
		});
		
		Ext.apply( this, {
			items: [
				{
					xtype: 'xdatefield',
					id: 'from',
					fieldLabel: 'From',
					anchor: '100%',
					allowBlank: false,
					format: 'jS F Y'
				},
				{
					xtype: 'xdatefield',
					id: 'to',
					fieldLabel: 'To',
					anchor: '100%',
					allowBlank: false,
					format: 'jS F Y'
				}
			]
		});		
		
		B2.Booking.BlockedDatePanel.superclass.initComponent.call( this );
	},
	
	loadBlockedDate: function( blockedDateId )
	{
		this.blockedDateId = blockedDateId;
		this.getForm().load({
			url: B2.MODULE_ROOT + '/booking/load-blocked-date.php',
			params: {
				blockedDateId: blockedDateId
			},
			waitMsg: 'Loading Blocked Date Details',
			waitTitle: 'Loading'
		});
	},
	
	saveBlockedDate: function()
	{
		this.getForm().submit({
			url: B2.MODULE_ROOT + '/booking/save-blocked-date.php',
			params: {
				blockedDateId: this.blockedDateId
			},
			waitMsg: 'Saving Blocked Date Details',
			waitTitle: 'Saving',
			success: function( form, action ) {
				this.fireEvent( 'saved' );
			},
			scope: this
		});
	}

});
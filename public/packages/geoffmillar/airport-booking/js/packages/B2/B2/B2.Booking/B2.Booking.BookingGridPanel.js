B2.Booking.BookingGridPanel = Ext.extend( Ext.grid.GridPanel, {

	viewConfig: {
		forceFit: true
	},

	initComponent: function()
	{
		this.store = new Ext.data.JsonStore({
			url: B2.MODULE_ROOT + '/booking/load-booking-list.php',
			totalProperty: 'numBookings',
			id: 'booking_id',
			root: 'bookings',
			fields: ['booking_id','customer_name', { name: 'trans_date', type: 'date', dateFormat: 'Y-m-d H:i:s' }, { name: 'from_date', type: 'date', dateFormat: 'Y-m-d' }, { name: 'to_date', type: 'date', dateFormat: 'Y-m-d' }],
			remoteSort: true,
			sortInfo: {
				field: 'trans_date',
				direction: 'DESC'
			},
			autoLoad: true
		});
				
		this.columns = [
			{ header: 'Booking ID', dataIndex: 'booking_id', width: 60, sortable: true },
			{ header: 'Customer Name', dataIndex: 'customer_name', sortable: true },
			{ header: 'Booked on', dataIndex: 'trans_date', sortable: true, renderer: Ext.util.Format.dateRenderer( 'H:i, jS F Y' ) },
			{ header: 'Outbound Date', dataIndex: 'from_date', sortable: true, renderer: Ext.util.Format.dateRenderer( 'jS F Y' ) },
			{ header: 'Inbound Date', dataIndex: 'to_date', sortable: true, renderer: Ext.util.Format.dateRenderer( 'jS F Y' ) }
			
		];				
		
		this.tbar = new Ext.Toolbar({
			items: [
				{
					xtype: 'tbbutton',
					iconCls: 'addicon',
					text: 'Add Booking',
					handler: this.onClickAddBookingButton,
					scope: this
				},
				{
					xtype: 'tbbutton',
					iconCls: 'editicon',
					text: 'Edit Booking',
					handler: this.onClickEditBookingButton,
					scope: this
				},
				{
					xtype: 'tbbutton',
					iconCls: 'delicon',
					text: 'Delete Booking',
					handler: this.onClickDeleteBookingButton,
					scope: this
				}
			]
		});
		
		this.bbar = new Ext.PagingToolbar({
			store: this.store,
			pageSize: 25
		});
		
		B2.Booking.BookingGridPanel.superclass.initComponent.call( this );		
	},
	
	onClickAddBookingButton: function()
	{
		var dlg = new B2.Booking.BookingDialog({
		});
		
		dlg.show();
	},
	
	onClickEditBookingButton: function()
	{
		var data = this.getSelectionModel().getSelected().data;
		var dlg = new B2.Booking.BookingDialog({
			bookingId: data.booking_id
		});
		
		dlg.on( 'close', function() {
			this.store.reload();
		}, this );
		
		dlg.show();
		dlg.loadBooking( data.booking_id );
		
	},
	
	onClickDeleteBookingButton: function()
	{
		Ext.Msg.show({
			title: 'Delete booking',
			msg: 'Are you sure you wish to delete this booking?',
			icon: Ext.Msg.QUESTION,
			buttons: Ext.Msg.YESNO,
			fn: this.onConfirmDeleteBooking,
			scope: this
		});
	},
	
	onConfirmDeleteBooking: function( btn )
	{
		if( btn == 'yes' )
		{
			var bookingId = this.getSelectionModel().getSelected().data.booking_id;
			Ext.Ajax.request({
				url: B2.MODULE_ROOT + '/booking/delete-booking.php',
				params: {
					bookingId: bookingId
				},
				success: function( response, options )
				{
					this.store.reload();
				},
				scope: this
			});
		}
	},
	
	search: function( records )
	{
		var searchTerms = new Array();
		for( var i=0, len=records.length; i<len; i++ )
		{
			searchTerms[i] = Ext.encode( records[i].data );
		}
		
		this.store.baseParams.searchTerms = Ext.encode( searchTerms );
		this.store.load();		
	}

});
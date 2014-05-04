B2.Booking.BookingListPanel = Ext.extend( Ext.Panel, {

	layout: 'border',
	gridPanel: null,
	searchPanel: null,

	initComponent: function()
	{
		this.gridPanel = new B2.Booking.BookingGridPanel({
			region: 'center'
		});
		this.searchPanel = new B2.Search.SearchPanel({
			region: 'north',
			collapsible: true,
			collapsed: true,
			split: true,
			height: 150,
			titleCollapse: true,
			typeComboArray: [
				['from_date','Outbound Date'],
				['to_date','Inbound Date'],
				['trans_date','Booking Date']
			],
			operatorComboArray: [
				['equal','Equal To'],
				['contains','Contains'],
				['greater','Greater than'],
				['less','Less than']
			],
			type: 'date'
		});
		
		Ext.apply( this, {
			items: [
				this.gridPanel,
				this.searchPanel
			]
		});
		
		this.searchPanel.on( 'search', function( records ) {
			this.gridPanel.search( records );
		}, this );
		
		B2.Booking.BookingListPanel.superclass.initComponent.call( this );
	}

});
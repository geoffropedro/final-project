B2.Booking.BookingReportPanel = Ext.extend( Ext.Panel, {

	layout: 'anchor',
	inboundGrid: null,
	outboundGrid: null,

	initComponent: function()
	{
		this.inboundGrid = new B2.Booking.BookingInboundGrid({
			id: 'inbound-grid',
			title: 'Inbound Flights',
			flightDir: 'inbound',
			anchor: '100% 50%'
		});

		this.outboundGrid = new B2.Booking.BookingOutboundGrid({
			id: 'outbound-grid',
			title: 'Outbound Flights',
			flightDir: 'outbound',
			anchor: '100% 50%'
		});

		this.tbar = new Ext.Toolbar({
			items: [{
				xtype: 'label',
				text: 'From Date: ',
				style: 'margin-right: 3px'
			},{
				xtype: 'xdatefield',
				id: 'booking-date-from',
				name: 'date-from',
				width:190,
				allowBlank:false,
				format: 'd F Y',
				submitFormat: 'Y-m-d',
				value: new Date()
			},{
				xtype: 'label',
				text: 'To Date: ',
				style: 'margin-left: 10px;margin-right: 3px'
			},{
				xtype: 'xdatefield',
				id: 'booking-date-to',
				name: 'date-to',
				width: 190,
				allowBlank:false,
				format: 'd F Y',
				submitFormat: 'Y-m-d',
				value: new Date(Date.now() + 30 * 24*3600*1000)
			},{
				xtype: 'button',
				text: "Fetch results",
				iconCls: 'actionicon',
				style: 'margin-left: 15px',
				handler: this.fetchData,
				scope: this
			}]
		});
		
		Ext.apply( this, {
			items: [
				this.outboundGrid,
				this.inboundGrid
			]
		});
		
		B2.Booking.BookingReportPanel.superclass.initComponent.call( this );
	},
	fetchData: function()
	{
		var valid = true;

		// get dates
		var dateFrom = Ext.util.Format.date(Ext.getCmp('booking-date-from').getValue(),'Y-m-d');
		var dateTo = Ext.util.Format.date(Ext.getCmp('booking-date-to').getValue(),'Y-m-d');
		
		if (dateFrom > dateTo)
		{
			Ext.Msg.show({
				title:'Info',
				msg:'The DATE FROM period selected is after the DATE TO period',
				buttons: Ext.MessageBox.OK,
				icon: Ext.MessageBox.INFORMATION
			});
			valid = false;
		}
		
		if (valid)
		{
			this.inboundGrid.loadStore(dateFrom,dateTo);
			this.outboundGrid.loadStore(dateFrom,dateTo);
		}
	}
});
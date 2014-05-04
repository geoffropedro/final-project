B2.Booking.BookingInvoiceGrid = Ext.extend( Ext.grid.GridPanel, {

	dateFrom: null,
	dateTo: null,

	viewConfig: { forceFit: true },

	initComponent: function()
	{
		this.store = new Ext.data.Store({
			url: '/ajax/booking/fetch-booking-report.php',
			// create reader that reads the Topic records
			reader: new Ext.data.JsonReader({
				root: 'items',
				totalProperty: 'results',
				idProperty: 'booking_id',
				fields: [
					'booking_id','name','contact_num','car_detail','flight','terminal',{name:'out_datetime',type:'date',dateFormat:'Y-m-d H:i:s'},{name:'in_datetime',type:'date',dateFormat:'Y-m-d H:i:s'},'alt_num','cost',{name:'trans_date',type:'date',dateFormat:'Y-m-d H:i:s'}
				]
			})
		});
		this.store.setDefaultSort('out_datetime', 'asc')
		
		this.store.on('load',function(st){ 
			if (st.getTotalCount()==0)
			{
				this.getView().emptyText = 'No results for the date range provided';
				this.getStore().removeAll();
			}
		},this);

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
				value: new Date()
			},{
				xtype: 'button',
				text: "Fetch results",
				iconCls: 'actionicon',
				style: 'margin-left: 15px',
				handler: this.fetchData,
				scope: this
			}]
		});
				
		this.columns = [
			{ header: 'ID', dataIndex: 'booking_id', width: 40 },
			{ header: 'Name', dataIndex: 'name' },
			{ header: 'Contact #', dataIndex: 'contact_num', width: 65 },
			{ header: 'Car details', dataIndex: 'car_detail', width: 150 },
			{ header: 'Flight #', dataIndex: 'flight', width: 45 },
			{ header: 'Terminal', dataIndex: 'terminal', width: 30 },
			{ header: 'Outbound', dataIndex: 'out_datetime', renderer: Ext.util.Format.dateRenderer('jS M Y H:i')},
			{ header: 'Inbound', dataIndex: 'in_datetime', renderer: Ext.util.Format.dateRenderer('jS M Y H:i')},
			{ header: 'Alt #', dataIndex: 'alt_num', width: 65 },
			{ header: 'Cost', dataIndex: 'cost', width: 50 },
			{ header: 'Transaction', dataIndex: 'trans_date',renderer: Ext.util.Format.dateRenderer('jS M Y H:i'), hidden: true }
		];

		this.tools = [{
			id: 'print',
			qtip: 'Printable version',
			handler: this.exportData,
			scope: this
		}];
		
		B2.Booking.BookingInvoiceGrid.superclass.initComponent.call( this );		
	},
	fetchData: function()
	{
		// set vars locally
		this.dateFrom = Ext.util.Format.date(Ext.getCmp('booking-date-from').getValue(),'Y-m-d');
		this.dateTo = Ext.util.Format.date(Ext.getCmp('booking-date-to').getValue(),'Y-m-d');

		// load the store with all needed params
		this.store.load({params:{datefrom: this.dateFrom, dateto: this.dateTo, reporttype: 'invoice'}});
	},
	exportData: function(event,toolEl,panel)
	{
		//alert('Feature under development');
		if (this.store.getTotalCount != 0)
		{
			window.open( '/ajax/booking/fetch-booking-report.php?datefrom=' + this.dateFrom + '&dateto=' + this.dateTo + '&reporttype=invoice&print=1', '_blank', '' );
		} else {
			Ext.Msg.show({
				title:'Info',
				msg:'Sorry no data to print',
				buttons: Ext.MessageBox.OK,
				icon: Ext.MessageBox.INFORMATION
			});
		}
	}
});
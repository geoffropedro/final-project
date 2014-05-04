B2.Booking.BookingOutboundGrid = Ext.extend( Ext.grid.GridPanel, {
	
	reportType: null,
	flightDir: null,
	dateFrom: null,
	dateTo: null,
	view: new Ext.grid.GridView({
		forceFit:true,
		enableRowBody:true,
		emptyText: 'No results found for date range specified'
	}),

	initComponent: function()
	{
		this.store = new Ext.data.GroupingStore({
			autoDestroy: true,
			url: '/ajax/booking/fetch-booking-report.php',
			// create reader that reads the Topic records
			reader: new Ext.data.JsonReader({
				root: 'items',
				totalProperty: 'results',
				idProperty: 'booking_id',
				fields: [
					'booking_id','name','contact_num','car_make','car_model','car_colour','car_reg','flight','terminal',{name:'out_datetime',type:'date',dateFormat:'Y-m-d H:i:s'},{name:'in_datetime',type:'date',dateFormat:'Y-m-d H:i:s'},'alt_num','cost',{name:'trans_date',type:'date',dateFormat:'Y-m-d H:i:s'}
				]
			}),
			sortInfo: {
				field: 'out_datetime',
				direction: 'ASC'
			}
		});
		
		//this.store.setDefaultSort('title', 'asc');
				
		this.columns = [
			{ header: 'ID', dataIndex: 'booking_id', width: 40 },
			{ header: 'Name', dataIndex: 'name' },
			{ header: 'Contact #', dataIndex: 'contact_num', width: 65 },
			{ header: 'Car details', dataIndex: 'car_detail', width: 150, renderer: this.renderCarDetail },
			{ header: 'Flight #', dataIndex: 'flight', width: 45 },
			{ header: 'Terminal', dataIndex: 'terminal', width: 30 },
			{ header: 'Outbound', dataIndex: 'out_datetime', renderer: Ext.util.Format.dateRenderer('jS F Y H:i')},
			{ header: 'Inbound', dataIndex: 'in_datetime', renderer: Ext.util.Format.dateRenderer('jS F Y H:i')},
			{ header: 'Alt #', dataIndex: 'alt_num', width: 65 },
			{ header: 'Cost', dataIndex: 'cost', width: 50 },
			{ header: 'Transaction date', dataIndex: 'trans_date', renderer: Ext.util.Format.dateRenderer('jS F Y H:i')}
		];

		this.tools = [
			{ 
				id: 'print',
				type: 'html',
				qtip: 'Printable version',
				handler: this.exportData,
				scope: this
			},{
				id: 'save',
				type: 'excel',
				qtip: 'Save as Excel',
				handler: this.exportData,
				scope: this
			}
		];
		
		B2.Booking.BookingOutboundGrid.superclass.initComponent.call( this );		
	},
        renderCarDetail: function(value, metaData, record, rowIndex, colIndex, store) 
        {
            return record.data.car_make+" "+record.data.car_model+" "+record.data.car_colour+" "+record.data.car_reg;
        },
	loadStore: function(dateFrom,dateTo,reportType)
	{
		// set vars locally
		this.dateFrom = dateFrom;
		this.dateTo = dateTo;
		this.reportType = reportType;

		// load the store with all needed params
		this.store.load({params:{datefrom: this.dateFrom, dateto: this.dateTo, flightdir:this.flightDir, reporttype: this.reportType}});
	},
	exportData: function(event,toolEl,panel,tc)
	{
		var exportType = tc.type;
		if (this.store.getTotalCount != 0)
		{
			window.open( '/ajax/booking/fetch-booking-report.php?datefrom=' + this.dateFrom + '&dateto=' + this.dateTo + '&reporttype=&flightdir='+this.flightDir+'&export='+exportType, '_blank', '' );
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

B2.Booking.BookingInboundGrid = Ext.extend( Ext.grid.GridPanel, {
	
	reportType: null,
	flightDir: null,
	dateFrom: null,
	dateTo: null,
	view: new Ext.grid.GridView({
		forceFit:true,
		enableRowBody:true,
		emptyText: 'No results found for date range specified'
	}),

	initComponent: function()
	{
		this.store = new Ext.data.GroupingStore({
			autoDestroy: true,
			url: '/ajax/booking/fetch-booking-report.php',
			// create reader that reads the Topic records
			reader: new Ext.data.JsonReader({
				root: 'items',
				totalProperty: 'results',
				idProperty: 'booking_id',
				fields: [
					'booking_id','name','contact_num','car_make','car_model','car_colour','car_reg','flight','terminal',{name:'out_datetime',type:'date',dateFormat:'Y-m-d H:i:s'},{name:'in_datetime',type:'date',dateFormat:'Y-m-d H:i:s'},'alt_num','cost',{name:'trans_date',type:'date',dateFormat:'Y-m-d H:i:s'}
				]
			}),
			sortInfo: {
				field: 'out_datetime',
				direction: 'ASC'
			}
		});
		
		//this.store.setDefaultSort('title', 'asc');
				
		this.columns = [
			{ header: 'ID', dataIndex: 'booking_id', width: 40 },
			{ header: 'Name', dataIndex: 'name' },
			{ header: 'Contact #', dataIndex: 'contact_num', width: 65 },
			{ header: 'Car details', dataIndex: 'car_detail', width: 150, renderer: this.renderCarDetail },
			{ header: 'Flight #', dataIndex: 'flight', width: 45 },
			{ header: 'Terminal', dataIndex: 'terminal', width: 30 },
			{ header: 'Outbound', dataIndex: 'out_datetime', renderer: Ext.util.Format.dateRenderer('jS F Y H:i'), hidden: true},
			{ header: 'Inbound', dataIndex: 'in_datetime', renderer: Ext.util.Format.dateRenderer('jS F Y H:i')},
			{ header: 'Alt #', dataIndex: 'alt_num', width: 65 },
			{ header: 'Cost', dataIndex: 'cost', width: 50 },
			{ header: 'Transaction date', dataIndex: 'trans_date', renderer: Ext.util.Format.dateRenderer('jS F Y H:i')}
		];

		this.tools = [
			{ 
				id: 'print',
				type: 'html',
				qtip: 'Printable version',
				handler: this.exportData,
				scope: this
			},{
				id: 'save',
				type: 'excel',
				qtip: 'Save as Excel',
				handler: this.exportData,
				scope: this
			}
		];
		
		B2.Booking.BookingInboundGrid.superclass.initComponent.call( this );		
	},
        renderCarDetail: function(value, metaData, record, rowIndex, colIndex, store)
        {
            return record.data.car_make+" "+record.data.car_model+" "+record.data.car_colour+" "+record.data.car_reg;
        },
	loadStore: function(dateFrom,dateTo)
	{
		// set vars locally
		this.dateFrom = dateFrom;
		this.dateTo = dateTo;

		// load the store with all needed params
		this.store.load({params:{datefrom: this.dateFrom, dateto: this.dateTo, flightdir:this.flightDir, reporttype: "schedule"}});
	},
	exportData: function(event,toolEl,panel,tc)
	{
		var exportType = tc.type;
		if (this.store.getTotalCount != 0)
		{
			window.open( '/ajax/booking/fetch-booking-report.php?datefrom=' + this.dateFrom + '&dateto=' + this.dateTo + '&reporttype=&flightdir='+this.flightDir+'&export='+exportType, '_blank', '' );
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
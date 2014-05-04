B2.Booking.BlockedDateGridPanel = Ext.extend( Ext.grid.GridPanel, {

	viewConfig: {
		forceFit: true
	},

	initComponent: function()
	{
		this.store = new Ext.data.JsonStore({
			url: B2.MODULE_ROOT + '/booking/load-blocked-date-list.php',
			totalProperty: 'numBlockedDates',
			id: 'blocked_date_id',
			root: 'blocked_dates',
			fields: ['blocked_date_id', { name: 'from', type: 'date', dateFormat: 'Y-m-d' }, { name: 'to', type: 'date', dateFormat: 'Y-m-d' } ],
			remoteSort: true,
			sortInfo: {
				field: 'from',
				direction: 'ASC'
			},
			autoLoad: true
		});
				
		this.columns = [
			{ header: 'From', dataIndex: 'from', sortable: true, renderer: Ext.util.Format.dateRenderer( 'jS F Y' ) },
			{ header: 'To', dataIndex: 'to', sortable: true, renderer: Ext.util.Format.dateRenderer( 'jS F Y' ) }
			
		];				
		
		this.tbar = new Ext.Toolbar({
			items: [
				{
					xtype: 'tbbutton',
					iconCls: 'addicon',
					text: 'Add Blocked Dates',
					handler: this.onClickAddBlockedDateButton,
					scope: this
				},
				{
					xtype: 'tbbutton',
					iconCls: 'editicon',
					text: 'Edit Blocked Dates',
					handler: this.onClickEditBlockedDateButton,
					scope: this
				},
				{
					xtype: 'tbbutton',
					iconCls: 'delicon',
					text: 'Delete Blocked Dates',
					handler: this.onClickDeleteBlockedDateButton,
					scope: this
				}
			]
		});
		
		this.bbar = new Ext.PagingToolbar({
			store: this.store,
			pageSize: 25
		});
		
		B2.Booking.BlockedDateGridPanel.superclass.initComponent.call( this );		
	},
	
	onClickAddBlockedDateButton: function()
	{
		var dlg = new B2.Booking.BlockedDateDialog({
		});
		
		dlg.on( 'close', function() {
			this.store.reload();
		}, this );
				
		dlg.show();
	},
	
	onClickEditBlockedDateButton: function()
	{
		var data = this.getSelectionModel().getSelected().data;
		var dlg = new B2.Booking.BlockedDateDialog({
			blockedDateId: data.blocked_date_id
		});
		
		dlg.on( 'close', function() {
			this.store.reload();
		}, this );
		
		dlg.show();
		dlg.loadBlockedDate( data.blocked_date_id );
		
	},
	
	onClickDeleteBlockedDateButton: function()
	{
		Ext.Msg.show({
			title: 'Delete blocked date',
			msg: 'Are you sure you wish to delete this blocked date?',
			icon: Ext.Msg.QUESTION,
			buttons: Ext.Msg.YESNO,
			fn: this.onConfirmDeleteBlockedDate,
			scope: this
		});
	},
	
	onConfirmDeleteBlockedDate: function( btn )
	{
		if( btn == 'yes' )
		{
			var blockedDateId = this.getSelectionModel().getSelected().data.blocked_date_id;
			Ext.Ajax.request({
				url: B2.MODULE_ROOT + '/booking/delete-blocked-date.php',
				params: {
					blockedDateId: blockedDateId
				},
				success: function( response, options )
				{
					this.store.reload();
				},
				scope: this
			});
		}
	}

});
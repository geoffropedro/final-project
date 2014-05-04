B2.RateCard.RateCardGrid = Ext.extend( Ext.grid.EditorGridPanel, {
	
	rateCardDialog: null,
	sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
	layout: 'fit',
	viewConfig: { 
		forceFit: true,
		emptyText: 'No results found'	
	},
	
	initComponent: function()
	{
		this.store = new Ext.data.JsonStore({
			url: B2.MODULE_ROOT + '/ratecard/load-ratecard.php',
			root: 'cards',
			fields: ['id','name',{name:'start_date',type:'date',dateFormat:'Y-m-d'},{name:'end_date',type:'date',dateFormat:'Y-m-d'},'active'],
			sortInfo: {
				field: 'name',
				direction: 'ASC'
			},
			autoLoad: true
		});
		
		this.columns = [
			{ header: 'Name', dataIndex: 'name', sortable: true },
			{ header: 'Start Date', dataIndex: 'start_date', sortable: true, renderer: Ext.util.Format.dateRenderer('dS F Y')},
			{ header: 'End Date', dataIndex: 'end_date', sortable: true, renderer: Ext.util.Format.dateRenderer('dS F Y')},
			{ header: 'Active', dataIndex: 'active', sortable: false }
		];



		this.tbar = new Ext.Toolbar({
			items: [
				new Ext.Button({
					text: 'Add Rate Card',
					iconCls: 'addicon',
					handler: this.showRateCardDialog,
					scope: this
				}),
				new Ext.Button({
					text: 'Edit Rate Card',
					iconCls: 'editicon',
					handler: this.showRateCardDialog,
					scope: this
				}),
				new Ext.Button({
					text: 'Edit Rate Card Prices',
					iconCls: 'priceicon',
					handler: this.editPricesDialog,
					scope: this
				})
			]
		});
		
		B2.RateCard.RateCardGrid.superclass.initComponent.call( this );
	},

	editPricesDialog: function(button,event)
	{
		// make sure you select a row first
		if (this.getSelectionModel().getCount() == 0)
		{
			Ext.Msg.show({
				title:'Info',
				msg:'Please select an item first',
				buttons: Ext.Msg.OK,
				icon: Ext.Msg.INFO
			});
		} else {
			// display dialog with editor grid 
			var pricesDialog = new B2.RateCard.RateCardPriceWindow({
				rateCardId: this.getSelectionModel().getSelected().data.id
			});
			pricesDialog.show();
		}
	},

	showRateCardDialog: function(button,event)
	{
		var rateCardId = 0;
		if (button.text == "Edit Rate Card")
		{
			if (this.getSelectionModel().getSelected() != null)
			{
				rateCardId = this.getSelectionModel().getSelected().data.id;
				this.rateCardDialog = new B2.RateCard.RateCardDialog({
					width: 500,
					height: 350,
					rateCardId: rateCardId,
					rateCardGrid: this
				});
				this.rateCardDialog.show();
			} else {
				Ext.Msg.show({
					title:'Info',
					msg:'Please select an item to edit',
					buttons: Ext.Msg.OK,
					icon: Ext.Msg.INFO
				});
			}
		} 
		else if (button.text == "Add Rate Card")
		{
			this.rateCardDialog = new B2.RateCard.RateCardDialog({
				width: 500,
				height: 350,
				rateCardId: rateCardId,
				rateCardGrid: this
			});
			this.rateCardDialog.show();
		}
	}
});
B2.RateCard.RateCardCostPanel = Ext.extend( Ext.grid.EditorGridPanel, {
	rateCardId: 0,
	viewConfig: {
		forceFit: true
	},
	
	initComponent: function()
	{
		this.store = new Ext.data.JsonStore({
			url: B2.MODULE_ROOT + '/ratecard/load-ratecard-cost.php',
			root: 'prices',
			id: 'num_days',
			fields: ['rate_card_id','days',{name:'cost', type:'float'}],
			sortInfo: {
				field: 'days',
				direction: 'ASC'
			},
			autoLoad: true,
			baseParams: { rateCardId: this.rateCardId }
		});
		
		this.columns = [
			{ header: 'Number of Days', dataIndex: 'days', sortable: true },
			{ header: 'Cost', dataIndex: 'cost', sortable: true, editor: new Ext.form.NumberField() }
		];
		
		B2.RateCard.RateCardCostPanel.superclass.initComponent.call( this );
		
		this.on( 'afteredit', this.onAfterEdit, this );
	},
	
	onAfterEdit: function( object )
	{
		var numDays = object.record.data.days;
		var cost = object.value;
		
		Ext.Ajax.request({
			url: B2.MODULE_ROOT + '/ratecard/save-ratecard-cost.php',
			params: {
				rateCardId: this.rateCardId,
				days: numDays,
				cost: cost
			}
		});
	}
});


B2.RateCard.RateCardPriceWindow = Ext.extend( Ext.Window, {
	title: 'Rate Card Prices',
	layout: 'fit',
	rateCardId: 0,
	rateCardCostPanel: null,
	width: 500,
	height: 400,
	
	initComponent: function()
	{
		this.rateCardCostPanel = new B2.RateCard.RateCardCostPanel({
			rateCardId: this.rateCardId
		});
		 
		Ext.apply( this, {
			items: [
				this.rateCardCostPanel
			],
			buttons: [
				{
					text: 'Close',
					iconCls: 'cancelicon',
					handler: this.onCloseClick,
					scope: this
				}
			]
		});
		
		B2.RateCard.RateCardPriceWindow.superclass.initComponent.call( this );
	},

	onCloseClick: function()
	{
		this.close();
	}
});
B2.Price.PriceGridPanel = Ext.extend( Ext.grid.EditorGridPanel, {

	viewConfig: {
		forceFit: true
	},
	
	initComponent: function()
	{
		this.store = new Ext.data.JsonStore({
			url: B2.MODULE_ROOT + '/price/load-price-list.php',
			root: 'prices',
			id: 'num_days',
			fields: ['num_days','cost','featured'],
			sortInfo: {
				field: 'num_days',
				direction: 'ASC'
			},
			autoLoad: true
		});
		
		this.columns = [
			{ header: 'Number of Days', dataIndex: 'num_days', sortable: true },
			{ header: 'Cost', dataIndex: 'cost', sortable: true, editor: new Ext.form.NumberField() },
			{ header: 'Featured', dataIndex: 'featured', editor: new Ext.form.ComboBox({ store: [['yes','Yes'],['no','No']], triggerAction: 'all' }) }
		];
		
		B2.Price.PriceGridPanel.superclass.initComponent.call( this );
		
		this.on( 'afteredit', this.onAfterEdit, this );
	},
	
	onAfterEdit: function( object )
	{
		var numDays = object.record.data.num_days;
		var value = object.value;
		
		Ext.Ajax.request({
			url: B2.MODULE_ROOT + '/price/save-price.php',
			params: {
				numDays: numDays,
				field: object.field,
				value: object.value
			}
		});
	}

});
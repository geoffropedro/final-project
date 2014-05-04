B2.Search.SearchPanel = Ext.extend( Ext.grid.EditorGridPanel, {

	title: 'Search',
	typeComboArray: null,
	operatorComboArray: null,
	type: '',
	
	initComponent: function()
	{
		this.addEvents({
			'search': true
		});
		
		this.store = new Ext.data.SimpleStore({
			data: [],
			fields: ['field','type','comparison','value']
		});
		
		this.sm = new Ext.grid.RowSelectionModel({
			singleSelect: true
		});

		var valueCol = { id: 'ValueCol', header: 'Value', dataIndex: 'value' };
		if( this.type == 'date' )
		{
			valueCol.editor = new Ext.form.DateField({
				format: 'Y-m-d'
			});
		}
		else
		{
			valueCol.editor = new Ext.form.TextField();
		}
		
		this.columns = [
			{ id: 'fieldNameCol', header: 'Field Name', dataIndex: 'field', editor: new Ext.form.ComboBox({
					triggerAction: 'all',
					store: this.typeComboArray,
					emptyText: 'Choose field...',
					mode: 'local'
				})
			 },
			{ id: 'headerCol', header: 'Operator', dataIndex: 'comparison', editor: new Ext.form.ComboBox({
					triggerAction: 'all',
					store: this.operatorComboArray,
					mode: 'local'
				})
			},
			valueCol
		];
		
		this.tbar = new Ext.Toolbar({
			items: [
				{
					xtype: 'tbbutton',
					iconCls: 'addicon',
					text: 'Add Search Term',
					handler: this.onClickAddSearchTerm,
					scope: this
				},
				{
					xtype: 'tbbutton',
					iconCls: 'delicon',
					text: 'Delete Search Term',
					handler: this.onClickDeleteSearchTerm,
					scope: this
				},
				{
					xtype: 'tbbutton',
					iconCls: 'clearicon',
					text: 'Clear All',
					handler: this.onClickClearAll,
					scope: this
				},
				'-',
				{
					xtype: 'tbbutton',
					iconCls: 'actionicon',
					text: 'Search Now',
					handler: this.onClickSearchNow,
					scope: this
				}
			]
		});
		
		B2.Search.SearchPanel.superclass.initComponent.call( this );
	},
	
	onClickAddSearchTerm: function()
	{
		this.store.add( new Ext.data.Record({
			field: '',
			type: '',
			comparison: '',
			value: ''
		}));
	},
	
	onClickDeleteSearchTerm: function()
	{
		var record = this.getSelectionModel().getSelected();
		this.store.remove( record );
	},
	
	onClickClearAll: function()
	{
	},
	
	onClickSearchNow: function()
	{
		this.fireEvent( 'search', this.store.getRange() );
	}

});
B2.User.UserListPanel = Ext.extend( Ext.Panel, {

	layout: 'border',
	gridPanel: null,
	searchPanel: null,

	initComponent: function()
	{
		this.gridPanel = new B2.User.UserGridPanel({
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
				['title','Title','varchar'],
				['firstname','Firstname','varchar'],
				['surname','Surname','varchar'],
				['email','Email','varchar']
			],
			operatorComboArray: [
				['equal','Equal To'],
				['contains','Contains'],
				['greater','Greater than'],
				['less','Less than']
			]
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
		
		B2.User.UserListPanel.superclass.initComponent.call( this );
	}

});
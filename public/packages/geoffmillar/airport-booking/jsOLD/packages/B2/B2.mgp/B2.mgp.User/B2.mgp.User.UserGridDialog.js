B2.User.UserGridDialog = Ext.extend( Ext.Window, {
	
	gridPanel: null,
	title: 'Select a User',
	itemId: 0,
	layout: 'fit',
	width: 800,
	height: 500,
	resizable: false,
	modal: true,
	
	initComponent: function()
	{
		this.gridPanel = new B2.User.UserGridPanel({
			title: '',
			height: this.height
		});
		
		this.addEvents({
			'selected': true
		});
		
		Ext.apply( this, {
			items: [
				this.gridPanel
			],
			buttons: [
				{
					text: 'Select',
					iconCls: 'accepticon',
					handler: function()
					{
						var record = this.gridPanel.getSelectionModel().getSelected();
						this.fireEvent( 'selected', record );
						this.close();
					},
					scope: this
				},
				{
					text: 'Cancel',
					iconCls: 'cancelicon',
					handler: function() {
						this.close();
					},
					scope: this
				}
			]
		});
		
		B2.User.UserDialog.superclass.initComponent.call( this );
	},
	
	loadUser: function( userId )
	{
		this.userId = userId;
		this.itemPanel.loadUser( userId );
	}
	
});
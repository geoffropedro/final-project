B2.User.UserDialog = Ext.extend( Ext.Window, {
	
	itemPanel: null,
	title: 'User Details',
	itemId: 0,
	layout: 'fit',
	width: 800,
	height: 500,
	resizable: false,
	modal: true,
	
	initComponent: function()
	{
		this.itemPanel = new B2.User.UserPanel({
			userId: this.itemId,
			title: ''
		});
		
		this.itemPanel.on( 'saved', function() {
			this.close();
		}, this );
		
		Ext.apply( this, {
			items: [
				this.itemPanel
			],
			buttons: [
				{
					text: 'Save',
					iconCls: 'accepticon',
					handler: function()
					{
						this.itemPanel.saveUser();
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
B2.User.UserGridPanel = Ext.extend( Ext.grid.GridPanel, {

	viewConfig: {
		forceFit: true
	},

	initComponent: function()
	{
		this.store = new Ext.data.JsonStore({
			url: B2.MODULE_ROOT + '/user/load-user-list.php',
			totalProperty: 'numUsers',
			id: 'user_id',
			root: 'users',
			fields: ['user_id','title','firstname','surname','contact_num','email'],
			remoteSort: true,
			sortInfo: {
				field: 'user_id',
				direction: 'ASC'
			},
			autoLoad: true
		});
				
		this.columns = [
			{ header: 'User ID', dataIndex: 'user_id', sortable: true, width: 25 },
			{ header: 'Name', renderer: this.renderFullName, width: 80, sortable: false },
			{ header: 'Contact Telephone', dataIndex: 'contact_num', sortable: true, width: 65 },
			{ header: 'Email', dataIndex: 'email', sortable: true }
		];				
		
		this.tbar = new Ext.Toolbar({
			items: [
				{
					xtype: 'tbbutton',
					iconCls: 'addicon',
					text: 'Add User',
					handler: this.onClickAddUserButton,
					scope: this
				},
				{
					xtype: 'tbbutton',
					iconCls: 'editicon',
					text: 'Edit User',
					handler: this.onClickEditUserButton,
					scope: this
				},
				{
					xtype: 'tbbutton',
					iconCls: 'delicon',
					text: 'Delete User',
					handler: this.onClickDeleteUserButton,
					scope: this
				}
			]
		});
		
		this.bbar = new Ext.PagingToolbar({
			store: this.store,
			pageSize: 25
		});
		
		B2.User.UserGridPanel.superclass.initComponent.call( this );		
	},

	renderFullName: function(value,page,record)
	{
		return String.format('{0} {1} {2}',record.data.title,record.data.firstname,record.data.surname);
	},
	
	onClickAddUserButton: function()
	{
		var dlg = new B2.User.UserDialog({
		});
		
		dlg.on( 'close', function() {
			this.store.reload();
		}, this );
		
		dlg.show();
	},
	
	onClickEditUserButton: function()
	{
		var data = this.getSelectionModel().getSelected().data;
		var dlg = new B2.User.UserDialog({
			userId: data.user_id
		});
		
		dlg.on( 'close', function() {
			this.store.reload();
		}, this );
		
		dlg.show();
		dlg.loadUser( data.user_id );
		
	},
	
	onClickDeleteUserButton: function()
	{
		Ext.Msg.show({
			title: 'Delete user',
			msg: 'Are you sure you wish to delete this user? This will delete all bookings related to this user!',
			icon: Ext.Msg.QUESTION,
			buttons: Ext.Msg.YESNO,
			fn: this.onConfirmDeleteUser,
			scope: this
		});
	},
	
	onConfirmDeleteUser: function( btn )
	{
		if( btn == 'yes' )
		{
			var userId = this.getSelectionModel().getSelected().data.user_id;
			Ext.Ajax.request({
				url: B2.MODULE_ROOT + '/user/delete-user.php',
				params: {
					userId: userId
				},
				success: function( response, options )
				{
					this.store.reload();
				},
				scope: this
			});
		}
	},
	
	search: function( records )
	{
		var searchTerms = new Array();
		for( var i=0, len=records.length; i<len; i++ )
		{
			searchTerms[i] = Ext.encode( records[i].data );
		}
		
		this.store.baseParams.searchTerms = Ext.encode( searchTerms );
		this.store.load();		
	}

});
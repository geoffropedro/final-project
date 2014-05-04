B2.User.UserPanel = Ext.extend( Ext.form.FormPanel, {

	title: 'User Details',
	userId: 0,
	height: 500,
	frame: true,
	border: true,
	
	initComponent: function()
	{
		this.addEvents({
			'saved': true
		});
		
		Ext.apply( this, {
			items: [
				{
					layout: 'column',
					items: [
						{
							columnWidth: .5,
							style: {
								'padding': '10px'
							},
							items: [
								{
									xtype: 'fieldset',
									height: 270,
									title: 'Main Details',
									defaults: {
										anchor: '100%'
									},
									items: [
										{
											xtype: 'combo',
											hiddenName: 'title',
											fieldLabel: 'Title',
											allowBlank: false,
											store: [['Mr','Mr'],['Mrs','Mrs'],['Miss','Miss'],['Ms','Ms'],['Dr','Dr']]
										},
										{
											xtype: 'textfield',
											id: 'firstname',
											allowBlank: false,
											fieldLabel: 'First Name'
										},
										{
											xtype: 'textfield',
											id: 'surname',
											allowBlank: false,
											fieldLabel: 'Last Name'
										},
										{
											xtype: 'combo',
											hiddenName: 'usertype',
											fieldLabel: 'User Type',
											allowBlank: false,
											store: [['Individual','Individual'],['Business','Business'],['Travel-Agent','Travel Agent']]
										},
										{
											xtype: 'textfield',
											id: 'password',
											allowBlank: false,
											fieldLabel: 'Password'
										},
										{
											xtype: 'xdatefield',
											id: 'joined_date',
											allowBlank: false,
											fieldLabel: 'Joined',
											format: 'jS F Y'
										},
										{
											xtype: 'hidden',
											id: 'joined_time'
										},
										{
											xtype: 'textarea',
											id: 'hearus',
											fieldLabel: 'Heard about us'
										}
									]
								},
								{
									xtype: 'fieldset',
									title: 'Contact Details',
									height: 180,
									defaults: {
										anchor: '95%'
									},
									items: [
										{
											xtype: 'textfield',
											id: 'contact_num',
											allowBlank: false,
											fieldLabel: 'Main Telephone'
										},
										{
											xtype: 'textfield',
											id: 'alt_phone',
											fieldLabel: 'Alt Telephone'
										},
										{
											xtype: 'textfield',
											id: 'alt_mobile',
											fieldLabel: 'Mobile Number'
										},
										{
											xtype: 'textfield',
											id: 'fax',
											fieldLabel: 'Fax'
										},
										{
											xtype: 'textfield',
											id: 'email',
											fieldLabel: 'Email'
										}
									]
								}
							]
						},
						{
							columnWidth: .5,
							style: {
								'padding': '10px'
							},							
							items: [
								{
									xtype: 'fieldset',
									height: 270,
									title: 'Address Details',
									defaults: {
										anchor: '100%'
									},
									items: [
										{
											xtype: 'textfield',
											id: 'address_line1',
											allowBlank: false,
											fieldLabel: 'Address Line 1'
										},
										{
											xtype: 'textfield',
											id: 'address_line2',
											fieldLabel: 'Address Line 2'
										},
										{
											xtype: 'textfield',
											id: 'address_line3',
											fieldLabel: 'Address Line 3'
										},
										{
											xtype: 'textfield',
											id: 'address_line4',
											fieldLabel: 'Address Line 4'
										},
										{
											xtype: 'textfield',
											id: 'post_town',
											allowBlank: false,
											fieldLabel: 'Post Town'
										},
										{
											xtype: 'textfield',
											id: 'county',
											fieldLabel: 'County'
										},
										{
											xtype: 'textfield',
											id: 'postcode',
											allowBlank: false,
											fieldLabel: 'Postcode'
										}
									]
								}
							]
						}
					]
				}
			]
		});		
		
		B2.User.UserPanel.superclass.initComponent.call( this );
	},
	
	loadUser: function( userId )
	{
		this.userId = userId;
		this.getForm().load({
			url: B2.MODULE_ROOT + '/user/load-user.php',
			params: {
				userId: userId
			},
			waitMsg: 'Loading User Details',
			waitTitle: 'Loading'
		});
	},
	
	saveUser: function()
	{
		this.getForm().submit({
			url: B2.MODULE_ROOT + '/user/save-user.php',
			params: {
				userId: this.userId
			},
			waitMsg: 'Saving User Details',
			waitTitle: 'Saving',
			success: function( form, action ) {
				this.fireEvent( 'saved' );
			},
			scope: this
		});
	}

});
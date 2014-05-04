B2.Booking.BookingPanel = Ext.extend( Ext.form.FormPanel, {

	title: 'Booking Details',
	bookingId: 0,
	height: 480,
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
									height: 380,
									title: 'General Details',
									defaults: {
										anchor: '100%'
									},
									items: [
										{
											xtype: 'trigger',
											id: 'client_name',
											fieldLabel: 'Client',
											readOnly: true,
											allowBlank: false,
											msgTarget: 'qtip',
											onTriggerClick: function()
											{
												var dlg = new B2.User.UserGridDialog({
													height: 500
												});
												dlg.on( 'selected', function( record ) {
													Ext.getCmp( 'user_id' ).setValue( record.data.user_id );
													Ext.getCmp( 'client_name' ).setValue( record.data.firstname );
												}, this );
												dlg.show();
											}
										},
										{
											xtype: 'hidden',
											id: 'user_id'
										},
										{
											xtype: 'xdatefield',
											id: 'trans_date_date',
											fieldLabel: 'Booking Date',
											allowBlank: false,
											format: 'jS F Y'
										},
										{
											xtype: 'hidden',
											id: 'trans_date_time'
										},
										{
											xtype: 'combo',
											hiddenName: 'status',
											fieldLabel: 'Status',
											allowBlank: false,
											store: [['pending','Pending'],['confirmed','Confirmed']]
										},
										{
											xtype: 'xdatefield',
											id: 'from_date',
											fieldLabel: 'Drop-off Date',
											allowBlank: false,
											format: 'jS F Y'
										},
										{
											xtype: 'textfield',
											id: 'from_time',
											allowBlank: false,
											fieldLabel: 'Drop-off Time'
										},
										{
											xtype: 'xdatefield',
											id: 'to_date',
											allowBlank: false,
											fieldLabel: 'Pick-up Date',
											format: 'jS F Y'
										},
										{
											xtype: 'textfield',
											id: 'to_time',
											allowBlank: false,
											fieldLabel: 'Pick-up Time'
										},
										{
											xtype: 'textfield',
											id: 'passphrase',
											fieldLabel: 'Passphrase'
										},
										{										
											xtype: 'textfield',
											id: 'discount_code',
											fieldLabel: 'Discount Code'
										},
										{										
											xtype: 'numberfield',
											id: 'discount',
											fieldLabel: 'Discount'
										},
										{										
											xtype: 'numberfield',
											id: 'cost',
											fieldLabel: 'Cost'
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
									height: 170,
									title: 'Car Details',
									defaults: {
										anchor: '100%'
									},
									items: [
										{
											xtype: 'textfield',
											id: 'car_make',
											fieldLabel: 'Make'
										},
										{
											xtype: 'textfield',
											id: 'car_model',
											fieldLabel: 'Model'
										},
										{
											xtype: 'textfield',
											id: 'car_colour',
											fieldLabel: 'Colour'
										},
										{
											xtype: 'textfield',
											id: 'car_reg',
											fieldLabel: 'Registration'
										},
										{
											xtype: 'numberfield',
											id: 'num_pass',
											fieldLabel: 'Passengers'
										}
									]
								},
								{
									xtype: 'fieldset',
									title: 'Flight Details',
									height: 200,
									defaults: {
										anchor: '95%'
									},
									items: [
										{
											xtype: 'textfield',
											id: 'destination',
											fieldLabel: 'Destination'
										},
										{
											xtype: 'textfield',
											id: 'out_flight',
											allowBlank: false,
											fieldLabel: 'Outbound Flight'
										},
										{
											xtype: 'combo',
											hiddenName: 'out_terminal',
											allowBlank: false,
											store: [['1','1'],['2','2'],['3','3'],['4','4'],['5','5']],
											fieldLabel: 'Outbound Terminal'
										},
										{
											xtype: 'textfield',
											id: 'in_flight',
											allowBlank: false,
											fieldLabel: 'Inbound Flight'
										},
										{
											xtype: 'combo',
											hiddenName: 'in_terminal',
											allowBlank: false,
											store: [['1','1'],['2','2'],['3','3'],['4','4'],['5','5']],
											fieldLabel: 'Inbound Terminal'
										},
										{
											xtype: 'combo',
											hiddenName: 'luggage',
											allowBlank: false,
											store: [['no','No'],['yes','Yes']],
											fieldLabel: 'Luggage',
											triggerAction: 'all'
										}
									]
								}
							]
						}
					]
				}
			]
		});		
		
		B2.Booking.BookingPanel.superclass.initComponent.call( this );
	},
	
	loadBooking: function( bookingId )
	{
		this.bookingId = bookingId;
		this.getForm().load({
			url: B2.MODULE_ROOT + '/booking/load-booking.php',
			params: {
				bookingId: bookingId
			},
			waitMsg: 'Loading Booking Details',
			waitTitle: 'Loading'
		});
	},
	
	saveBooking: function()
	{
		if( this.getForm().isValid() )
		{
			this.getForm().submit({
				url: B2.MODULE_ROOT + '/booking/save-booking.php',
				params: {
					bookingId: this.bookingId
				},
				waitMsg: 'Saving Booking Details',
				waitTitle: 'Saving',
				success: function( form, action ) {
					this.fireEvent( 'saved' );
				},
				scope: this
			});
		}
	}

});
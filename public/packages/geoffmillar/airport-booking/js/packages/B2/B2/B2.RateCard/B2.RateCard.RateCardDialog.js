B2.RateCard.RateCardPanel = Ext.extend( Ext.FormPanel, {
	
	labelAlign: 'right',
	frame: true,
	autoScroll: true,
	waitMsgTarget: true,
	rateCardId: null,

	initComponent: function()
	{
		Ext.apply( this, {
			items: [
				new Ext.form.FieldSet({
					width: 470,
					title: 'Details',
					height: 200,
					collapsible: false,
					labelWidth: 165,
					defaultType: 'combo',
					items: [
					{
						xtype: 'textfield',
						width: 250,
						fieldLabel: 'Name',
						value: '',
						name: 'name',
						allowBlank: false,
						blankText: 'Please enter a name for this rate card'
					},{
						fieldLabel: 'Start Date',
						xtype: 'xdatefield',
						name: 'start_date',
						format: 'd F Y',
						submitFormat: 'Y-m-d',
						value: new Date(),
						width: 125
					},{
						fieldLabel: 'End Date',
						xtype: 'xdatefield',
						name: 'end_date',
						format: 'd F Y',
						submitFormat: 'Y-m-d',
						value: new Date(),
						width: 125
					},{
						fieldLabel: 'Active',
						id: 'ratecard-activecombo',
						mode: 'local',
						store: [['yes','yes'],['no','no']],
						displayField: 'value',
						valueField: 'value',
						emptyText: 'Select...',
						hiddenName: 'active',
						width: 100,
						triggerAction: 'all',
						value: 'no'
					},{
						id: 'ratecard-warninglabel',
						xtype: 'label',
						text: 'The active box is forced to be NO as you need to enter prices first before it can be made active'
						
					}]
				})
			],
			buttons: [{
				text: 'Save',
				iconCls: 'accepticon',
				handler: this.saveRateCard,
				scope: this
			}]
		});

		B2.RateCard.RateCardPanel.superclass.initComponent.call( this );

		if (this.rateCardId != 0)
		{
			this.loadRateCard();
			// hide the warning label
			Ext.getCmp('ratecard-warninglabel').hidden = true;
		} else {
			// disable the active combo (add)
			Ext.getCmp('ratecard-activecombo').disabled = true;
		}
	},

	loadRateCard: function()
	{
		// load up the form with all the card details
		this.getForm().load({
			url: '/ajax/ratecard/load-ratecard-item.php',
			params: {
				rateCardId: this.rateCardId
			},
			waitMsg: 'Fetching data....',
			failure: function( form, action ) {
				var msg = action.result.message;
				if (msg != '') {
					Ext.Msg.show({
						title:'Info',
						msg:msg,
						buttons: Ext.Msg.OK,
						icon: Ext.Msg.INFO
					});
				}
			},
			scope: this
		});
	},
	
	saveRateCard: function()
	{
		// validate
		var formValues = this.getForm().getValues();
		// make sure start date before end date
		if (formValues["start_date"] > formValues["end_date"])
		{
			Ext.Msg.show({
				title:'Info',
				msg:'The start date is after the end date',
				buttons: Ext.Msg.OK,
				icon: Ext.Msg.WARNING
			});
			return;
		} 

		if (formValues["name"] == "")
		{
			Ext.Msg.show({title:'Info',msg:'Please enter a name for the Rate Card',buttons:Ext.Msg.OK,icon:Ext.Msg.WARNING});
			return;
		}

		// call xhr to save
		this.getForm().submit({
			scope: this,
			url: '/ajax/ratecard/save-ratecard-item.php',
			waitMsg: 'Saving data...',
			params: {
				rateCardId: this.rateCardId
			},
			success: function( form, action ) {
				Ext.Msg.show({
					title:'Info',
					msg:'Record has been saved successfully.',
					buttons: Ext.Msg.OK,
					icon: Ext.Msg.INFO
				});
				// reset the form so its ready for another entry (if adding)
				if (this.rateCardId == 0)
				{
					this.getForm().reset();
				}
			},
			failure: function( form, action) {
				var msg = action.result.message;
				if (msg != '') {
					Ext.Msg.show({
						title:'Info',
						msg:msg,
						buttons: Ext.Msg.OK,
						icon: Ext.Msg.INFO
					});
				}
			}
		});
	}

});

B2.RateCard.RateCardDialog = Ext.extend( Ext.Window, {
	title: 'Rate Card',
	layout: 'fit',
	rateCardId: 0,
	rateCardPanel: null,
	rateCardGrid: null,
	
	initComponent: function()
	{
		this.rateCardPanel = new B2.RateCard.RateCardPanel({
			rateCardId: this.rateCardId
		});
		 
		Ext.apply( this, {
			items: [
				this.rateCardPanel
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
		
		B2.RateCard.RateCardDialog.superclass.initComponent.call( this );
	},

	onCloseClick: function()
	{
		this.close();
		this.rateCardGrid.getStore().reload();
	}
});
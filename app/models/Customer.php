<?php

class Customer extends Eloquent  {

	protected $table = 'customer';

	protected $fillable = array('title', 'firstname', 'surname', 'address_line1','address_line2','post_town','post_code','contact_num','alt_phone','email', 'joined');

	public $timestamps = false;









}
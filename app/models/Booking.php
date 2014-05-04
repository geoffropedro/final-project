<?php

class Booking extends Eloquent {
	
	protected $table = 'booking';

	protected $fillable = array('from_date', 'to_date', 'from_time', 'to_time','user_id','car_make','car_model','car_colour','car_reg','num_pass', 'destination' ,'out_flight','out_terminal','in_flight','in_terminal','trans_date','num_days');

	public $timestamps = false;

}














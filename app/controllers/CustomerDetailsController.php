<?php

class CustomerDetailsController extends BaseController {

	protected $customer;
	protected $booking;

	public function __construct(Customer $customer, Booking $booking)
	{
		$this->customer = $customer;
		$this->booking = $booking;
	}

	public function index()
	{
		//Get all post
		$input = Input::all();

		$rules = [
		'title'			=> 'required|not_in:0',
		'firstname'		=> 'required',
		'surname'		=> 'required',
		'address_line1'	=> 'required',
		'address_line2'	=> 'required',
		'post_town'		=> 'required',
		'postcode'		=> 'required',
		'country'		=> 'required',
		'contact_num'	=> 'required',
		'alt_phone'		=> 'required',
		'email'			=> 'required|email',
		'confirm_email'	=> 'required|email|same:email',
		'car_make'		=> 'required',
		'car_model'		=> 'required',
		'car_colour'	=> 'required',
		'car_reg'		=> 'required',
		'out_flight'	=> 'required',
		'out_terminal'	=> 'required|not_in:0',
		'in_flight'		=> 'required',
		'in_terminal'	=> 'required|not_in:0',
		'confirmation'	=> 'required'
		];

		//Validate
		$validator = Validator::make($input, $rules);

		//If validate fails return with errors and input
		if ($validator->fails())
			return Redirect::back()->withErrors($validator)->withInput();

		//Add joined date to model
		$input['joined'] = date("Y-m-d H:i:s");

		//Fill the model
		$this->customer->fill($input);
		//Save the model
		$this->customer->save();
		//Get customer id
		$customerId = $this->customer->id;


		//Save the booking as pending
		$booking = Session::get('booking');

		//DEVELOPMENT CONTINUES HERE
		$this->booking->in_flight ="asd";
		$this->booking->fill($input);
		$this->booking->save();





		$parentarray = array();
		foreach ($input as $name => $value) 
		{
			$booking->$name = $value;

		}




		Session::put('booking', $booking);

		return Redirect::to('payment');



	}
}
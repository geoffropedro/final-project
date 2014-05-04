<?php

use GeoffMillar\Admin\Models\Setting;
use GeoffMillar\Theme\Models\Theme;
use GeoffMillar\Admin\Models\Page;
use GeoffMillar\Slider\Models\Slider;


class QuoteController extends BaseController {

	protected $booking;
	protected $minBookingTime = 5; 	//Minimum booking time hours
	protected $maxBookingDays = 30;	//Max number of days you can book
	protected $vatRate = 20.0;	//Max number of days you can book

	public function __construct(Booking $booking)
	{
		$this->booking = $booking;
	}

	public function index()
	{
		//Add post to session
		$input = Input::all();
		Session::put('FROM_DATE', $_REQUEST['StartDateAlt']);
		Session::put('FROM_TIME', $_REQUEST['dth'].":".$_REQUEST["dtm"]);
		Session::put('TO_DATE', $_REQUEST['EndDateAlt']);
		Session::put('TO_TIME', $_REQUEST['rth'].":".$_REQUEST["rtm"]);
		Session::put('DISCOUNT', str_replace(" ", "", strtolower(empty($_REQUEST['d'])) ? "":strtolower($_REQUEST["d"])));

		// Delete any pending bookings that are older than 5 minutes?
		DB::raw("delete from 'booking' where TIMEDIFF(NOW(),trans_date) > '00:5:00' and status='pending'");

		// Validation
		$valid = true; 
		// Hold messages
		$messages 		= array(); 
		$nowDate 		= date('Y-m-d');
		$nowTime 		= date('H:i:s');

		// Get dates and times
		$fromDate 		= Session::get('FROM_DATE');
		$fromDateArray 	= explode("-",$fromDate);
		$fromTime 		= Session::get('FROM_TIME');
		$toDate 		= Session::get('TO_DATE');
		$toDateArray 	= explode("-",$toDate);
		$toTime 		= Session::get('TO_TIME');

		// Check if dates are valid
		if ($fromDate < $nowDate)
		{
			$messages[] = 'The Outbound drop-off date ('.$fromDate.') you selected was before TODAY!';
			$valid = false;
		}

		if (($toDate < $nowDate) || ($toDate < $fromDate))
		{
			$messages[] = 'Inbound Flight Landing Time you have selected is before the Outbound Drop Off Time, please check your details and try again';
			$valid = false;
		}

		if (($fromDate == $nowDate) && ($fromTime < $nowTime))
		{
			$messages[] = 'You are trying to book a parking slot on a date that has already passed, please check your details and try again';
			$valid = false;
		}


		$time12hours = time() + (60 * 60 * 12);
		$timeOutbound = mktime($fromTime[0],$fromTime[1],0,$fromDateArray[1],$fromDateArray[2],$fromDateArray[0]);

		if ($timeOutbound <= $time12hours)
		{
			$messages[] = "You are making a booking within 12 hours of the Drop Off Time, please call us with your booking.";
			$valid = false;
		}

		$firstBookingTime = date('Y-m-d H:i:s',mktime(date('H')+1,date('i'),date('s'),date('m'),date('d'),date('Y')));

		// If same day booking, check that times are far enough apart
		if ($toDate == $fromDate)
		{
			if ($toTime < $fromTime)
			{
				$messages[] = 'The Inbound flight landing time must be after the Outbound drop-off time';
				$valid = false;
			} 
			else 
			{

				$result = DB::select("select TIMEDIFF('$toTime','$fromTime') < '0".$this->minBookingTime.":00:00'");

                if (count($result) > 0) { // booking not allowed
                	$messages[] = "You have tried to book for too short a period. The minimum booking time for one day is: <b>".$this->minBookingTime." hours</b>";
                	$valid = false;
                }
            }
        }

		// Check for early pickups
        $fromTimeArray = explode(":",$fromTime);
        $toTimeArray = explode(":",$toTime);
        if (($fromTimeArray[0] < 4) || ($toTimeArray[0] < 4))
        {
        	$messages[] = "Unfortunately we do not operate before 04.00 for departures/arrivals. Please change you time to later or please call the office on 01342 843842";
        	$valid = false;
        }



		// Calculate dates between TO and FROM dates
        $result = DB::select("select DATEDIFF('".Toolkit::safestr($toDate)."','".Toolkit::safestr($fromDate)."')+1 as days");
        $bookingDays = $result[0]->days;




        // Check booking length
        $sql = "select DATEDIFF('".Toolkit::safestr($toDate)."','".Toolkit::safestr($fromDate)."')+1 as days";
        $dayDiff = DB::select($sql);
        if ($dayDiff[0]->days > $this->maxBookingDays)
        {
        	$messages[] = "You have tried to book for over 30 days, if this is correct, you will need to call us to arrange long term parking.";
        	$valid = false;
        }

        //If errors return view with messages
        if ($messages){

		if (Session::has('booking'))
			Session::forget('booking');

        	return Redirect::to('quote')->withErrors($messages);
        }


        //Else start the booking process
        $result = DB::select("SELECT id,name FROM rate_card WHERE '".Toolkit::safestr($fromDate)."' BETWEEN start_date AND end_date AND active='yes'");

        if (count($result) > 0)
        {
        	// Get the rate card id from the result
        	$rateCardId = $result[0]->id;
			// Get the price for the number of days requested
        	$result = DB::select("SELECT cost FROM rate_card_price WHERE rate_card_id=".$rateCardId." AND days=".Toolkit::safestr($bookingDays));
        	$totalPrice = $result[0]->cost;
        } else {
        	$result = DB::select("SELECT cost FROM price WHERE num_days=" . Toolkit::safestr($bookingDays));
        	$totalPrice = $result[0]->cost;
        }


		// Vat price (might not be needed??)
        $prevatPrice = (100/(100 + $this->vatRate)) * $totalPrice;

		// Surcharges
        $surcharges = array();
        if (($fromTime[0] == 4) || ($fromTime[0] == 5 && $fromTime[1] == 0))
        {
        	$surcharges["Outbound 04:00 to 05:00 meeting - unsociable hours special service"] = 20;
        }

        if (($toTime[0] == 4) || ($toTime[0] == 5 && $toTime[1] == 0))
        {
        	$surcharges["Inbound 04:00am to 05:00 meeting - unsociable hours special service"] = 20;
        }

        $surchargeCost = 0.00;
        foreach ($surcharges as $a=>$b)
        {
        	$surchargeCost+=$b;
        }

        $totalCost = $totalPrice + $surchargeCost;
        $finalCost = $totalCost; //       

		// check for discount (NOT CURRENTLY WORKING)
        $discountPrice = 0;
        $discountCode = '';
        $discountAmount = 0.00;


        /***********
		NEED TO ADD DISCOUNT
        **************/




		$booking = new stdClass();
		$booking->bookingDays 	= $bookingDays;
		
		$booking->fromDate 		= $fromDate;
		$booking->fromTime 		= $fromTime;


		$booking->toDate 		= $toDate;
		$booking->toTime 		= $toTime;

		$booking->totalPrice 	= $totalPrice;




		Session::put('booking', $booking);


		return Redirect::to('quote')->withInput();


	}

}
@extends('admin::layouts.default')

@section('header')
	{{ HTML::style('packages/geoffmillar/airport-booking/js/packages/ext/resources/css/ext-all.css')}}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/calendar.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/ext/adapter/ext/ext-base.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/ext/ext-all.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2.Search/B2.Search.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2.Search/B2.Search.SearchPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Price/B2.Price.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Price/B2.Price.PriceGridPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.RateCard/B2.RateCard.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.RateCard/B2.RateCard.RateCardDialog.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.RateCard/B2.RateCard.RateCardCostPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.RateCard/B2.RateCard.RateCardGrid.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.User/B2.User.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.User/B2.User.UserPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.User/B2.User.UserDialog.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.User/B2.User.UserGridPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.User/B2.User.UserGridDialog.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.User/B2.User.UserListPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BlockedDatePanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BlockedDateDialog.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BlockedDateGridPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BookingPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BookingDialog.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BookingGridPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BookingListPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BookingReportPanel.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BookingReportGrid.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/B2/B2.Booking/B2.Booking.BookingInvoiceGrid.js') }}
	{{ HTML::script('packages/geoffmillar/airport-booking/js/packages/B2/Ext.ux.form.XDateField.js') }}
	<style>
	.bigText {font-size:28px;}
	</style>
@stop

@section('main')
@parent

<div class="row">
	<div class="col-sm-1">
	@include('airport-booking::partials.nav')
	</div>

	<div class="col-sm-11">
		@yield('booking-content')
	</div>

</div>
@stop

<div class="form-wrap">

    {{ Form::open(array('url' => 'quote', 'method' => 'POST' , 'id'=>'quote-form')) }}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {{Form::label('StartDate', 'Departure Date:')}}
                {{Form::text('StartDate', null , ['class'=>'startdatefield form-control', 'id'=>'StartDate', 'readonly'=>'readonly']);}}
                {{Form::hidden('StartDateAlt', null , ['id'=>'StartDateAlt']);}}
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                {{Form::label('StartDateDay', 'Drop Off Time::')}}<br/>

                <select size="1" name="dth" id="dth" class="selecthour form-control" style="width:70px; display:inline-block">
                    @for ($i = 0; $i <= 23; $i++)
                    <option <?= (str_pad($i, 2, '0', STR_PAD_LEFT) == 06) ? ' selected ' : '';  ?> value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                    @endfor
                </select>

                <select size="1" name="dtm" id="dtm" class="selectmin form-control" style="width:70px; display:inline-block">
                    @for ($i = 0; $i <= 50; $i = $i + 10)
                    <option <?= (str_pad($i, 2, '0', STR_PAD_LEFT) == 0) ? ' selected ' : '';  ?> value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {{Form::label('EndDate', 'Return Landing Date:')}}
                {{Form::text('EndDate', null , ['class'=>'startdatefield form-control', 'id'=>'EndDate', 'readonly'=>'readonly']);}}
                {{Form::hidden('EndDateAlt', null , ['id'=>'EndDateAlt']);}}
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                {{Form::label('StartDateDay', 'Drop Off Time::')}}<br/>

                <select size="1" name="rth" id="rth" class="selecthour form-control" style="width:70px; display:inline-block">
                    @for ($i = 0; $i <= 23; $i++)
                    <option <?= (str_pad($i, 2, '0', STR_PAD_LEFT) == 06) ? ' selected ' : '';  ?> value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                    @endfor
                </select>

                <select size="1" name="rtm" id="rtm" class="selectmin form-control" style="width:70px; display:inline-block">
                    @for ($i = 0; $i <= 50; $i = $i + 10)
                    <option <?= (str_pad($i, 2, '0', STR_PAD_LEFT) == 0) ? ' selected ' : '';  ?> value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-6">
            {{Form::label('Discount code', 'Discount code')}}
            {{Form::text('d', null , ['class'=>'startdatefield form-control']);}}
        </div>

        <div class="form-group col-sm-6">
            <button type="submit" class="btn btn-primary">QUOTE</button>
        </div>
    </div>
    {{ Form::close() }}
</div>



<script type="text/javascript">

<?php if(isset($booking))
{

    $tmpFromDate = explode("-", $booking->fromDate);
    $tmpFromDateStr = "'".$tmpFromDate[0]."','".($tmpFromDate[1]-1)."','".$tmpFromDate[2]."'";
    ?>

    var defaultStartDate = new Date(<?php  echo $tmpFromDateStr;?>);
    <?php  
} else 

{ ?>
    var defaultStartDate = new Date();
    defaultStartDate.setDate(defaultStartDate.getDate()+1);
    <?php  
} 

if (!empty($_SESSION["TO_DATE"])) 
{
    $tmpToDate = explode("-",$_SESSION["TO_DATE"]);
    $tmpToDateStr = "'".$tmpToDate[0]."','".($tmpToDate[1]-1)."','".$tmpToDate[2]."'";
    ?>

    var defaultEndDate = new Date(<?php echo $tmpToDateStr;?>);
    <?php 
} else 
{ ?>
    var defaultEndDate = new Date();
    defaultEndDate.setDate(defaultEndDate.getDate()+8);
    <?php 
} 

$startTime = empty($_SESSION["FROM_TIME"]) ? "06:00" : $_SESSION["FROM_TIME"];
$endTime = empty($_SESSION["TO_TIME"]) ? "23:00" : $_SESSION["TO_TIME"];

$startTimeArray = explode(":",$startTime);
$endTimeArray = explode(":",$endTime);
?>
var defaultStartHour = '<?php echo $startTimeArray[0];?>';
var defaultStartMin = '<?php echo $startTimeArray[1];?>';
var defaultEndHour = '<?php echo $endTimeArray[0];?>';
var defaultEndMin = '<?php echo $endTimeArray[1];?>';

// initialise the disabled days
var disabledDays = [<?php echo fetchDisabledDates($blockedDates);?>];

$(function() {

    var startDate =$( "#StartDate" ).datepicker({
        minDate: new Date(<?php echo date('Y');?>, <?php  echo date('m')-1;?> , <?php  echo date('d');?> ),
        dateFormat: 'dd-mm-yy',
        defaultDate: null,
        numberOfMonths: 2,
        altField: '#StartDateAlt',
        altFormat: 'yy-mm-dd',
        beforeShowDay: checkDisabledDates,
        onSelect: function( selectedDate ) 
        {
            var option = "minDate";
            instance = $( this ).data( "datepicker" );
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings );
            endDate.not( this ).datepicker( "option", option, date );
            // change the end date to be 7 days from the selected date
            endDate.datepicker('setDate',selectedDate);
            endDate.datepicker('setDate','c+7d'); // c = relative to current date 
        } 
    });

    var endDate = $( "#EndDate" ).datepicker({
        minDate: new Date(<?php echo date('Y');?>, <?php echo date('m')-1;?> , <?php echo date('d');?> ),
        dateFormat: 'dd-mm-yy',
        defaultDate: '+2d',
        numberOfMonths: 2,
        altField: '#EndDateAlt',
        altFormat: 'yy-mm-dd',
        beforeShowDay: checkDisabledDates,
        onSelect: function( selectedDate ) {
            var option = "maxDate",
            instance = $( this ).data( "datepicker" );
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings );
            startDate.not( this ).datepicker( "option", option, date );
        }   
    }); 

    // Default values
    $('#StartDate').val($.datepicker.formatDate('dd-mm-yy', defaultStartDate));
    $('#StartDateAlt').val($.datepicker.formatDate('yy-mm-dd', defaultStartDate));
    $('#EndDate').val($.datepicker.formatDate('dd-mm-yy', defaultEndDate));
    $('#EndDateAlt').val($.datepicker.formatDate('yy-mm-dd', defaultEndDate));
    $('#dth').val(defaultStartHour);
    $('#dtm').val(defaultStartMin);
    $('#rth').val(defaultEndHour);
    $('#rtm').val(defaultEndMin);

    function checkDisabledDates(selDate,picker)
    {
        var dateStr = $.datepicker.formatDate('yy-mm-dd',selDate);
        var result = $.inArray( dateStr, disabledDays ) ==-1 ? [true] : [false];
        return result;
    }
});

</script>

<?php 

function fetchDisabledDates($blockedDates)
{
 
 $dates = array();

 foreach ($blockedDates as $date)
 {
    $dateFrom = $date->from;
    $dateTo = $date->to;

    //Go through dates adding to array
    $curDate = $dateFrom; // start from FROM date
    while ($curDate <= $dateTo)
    {
        //Add to array
        $dates[] = '"'.$curDate.'"';

        //Increment current day by 1
        $newDateTime = strtotime ( '+1 day' , strtotime ( $curDate ) );
        $curDate = date('Y-m-d',$newDateTime);
    }
}
return implode(",",$dates);
}

?>
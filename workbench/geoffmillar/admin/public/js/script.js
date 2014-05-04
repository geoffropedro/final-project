function confirmDelete(){
	var r=confirm("Confirm delete");
	if (r==true)
	{
		return true;
	}
	else
	{
		return false;
	} 
}


function saveRouting(id)
{
$("#save").val(id);
$(this).closest('form').submit()
}


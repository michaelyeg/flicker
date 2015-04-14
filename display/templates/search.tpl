~include file="header.tpl"`
<div class="header">
	<h1>Welcome ~$fname` ~$lname`!</h1>
</div>
~if $msg eq 'gsuccess'`
	<h2>You have successfully Edited Group.</h2>
~else if $msg eq 'dsuccess'`
	<h2>You have successfully Deleted Group.</h2>
~/if`
<p>Now you can share photos with your friends.</p>
<div class="form">
<div class="grplist">
	<form action="searchResult.php" method="POST" class="form">
	<h1 class="grpHeading fleft">Search Photo</h1>
	<h1 class="grpHeading fright"><input type="submit" class="colored try-it-btn" value="Search Photo"/></h1>
	<ul class="left-form" style="width:80%">
		<li>
			<input type="text" placeholder="Enter Keyword(s)" name="keywords" id="keywords" maxlength="24" required/>
			<div class="clear"></div>
		</li>
		<li>
			Select Condition
			<input type="radio" name="condition" value="and" />AND
			<input type="radio" name="condition" value="or"/>OR
			<div class="clear"></div>
		</li>
		<li>
			<input type="text" placeholder="From" name="from" id="from" readonly/>
			<div class="clear"></div>
		</li>
		<li>
			<input type="text" placeholder="To" name="to" id="to" readonly/>
			<div class="clear"></div>
		</li>
		<div class="clear"> </div>
		<li>
			Select Sorting<br/>
			<input type="radio" name="sorting" value="desc" />Most Recent First<br/>
			<input type="radio" name="sorting" value="asc" />Most Recent Last<br/>
			<input type="radio" name="sorting" value="auto" checked/>Auto
			<div class="clear"></div>
		</li>
	</ul>
	</form>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
    $( "#from" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    $( "#to" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
  </script>
~include file="footer.tpl"`
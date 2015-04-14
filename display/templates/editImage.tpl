~include file="header.tpl"`
<div class="header">
	<h1>Welcome ~$fname` ~$lname`!</h1>
</div>
<p>Now you can share photos with your friends.</p>
<div class="form">
<div class="grplist">
	<h1 class="grpHeading">~$arrPhotoData.subject`</h1>
	<img src="showImage.php?id=~$arrPhotoData.photo_id`&type=full"/>
</div>
<div class="grplist" style="border:0px">
	<form action="updateImage.php" method="POST" class="form">
	<h1 class="grpHeading fleft">Edit Photo</h1>
	<h1 class="grpHeading fright"><input type="submit" class="colored try-it-btn" value="Update Photo"/></h1>
	<input type="hidden" name="photoId" value="~$arrPhotoData.photo_id`" />
	<ul class="left-form" style="width:80%">
		<li>
			<input type="text" placeholder="Enter Subject" name="subject" id="subject" maxlength="128" value="~$arrPhotoData.subject`"/>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="subjectErr"></li>
		<li>
			<input type="text" placeholder="Where the Images were Clicked" name="place" id="place" maxlength="128" value="~$arrPhotoData.place`"/>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="placeErr"></li>
		<li>
			<input type="text" placeholder="When the Images were Clicked" name="date" id="datepicker1" readonly/>
			<div class="clear"></div>
		</li>
		<li>
			<textarea class="txtArea" placeholder="Enter Description" name="description" id="description" maxlength="2048">~$arrPhotoData.description`</textarea>
			<div class="clear"></div>
		</li>
		<li>
			<input type="radio" name="permission" value="2" ~if $arrPhotoData.permitted eq 2` checked ~/if`/>Private
			<input type="radio" name="permission" value="1" ~if $arrPhotoData.permitted eq 1` checked ~/if`/>Public
			~foreach from = $arrGroupData key=index item=arrData` 
				<input type="radio" name="permission" value="~$arrData.group_id`" ~if $arrPhotoData.permitted eq $arrData.group_id` checked ~/if`/>~$arrData.group_name`
			~/foreach`
		</li>
		<li class="error dispNone" id="descriptionErr"></li>
		<div class="clear"> </div>
	</ul>
	</form>
</div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
  $(function() {
	var currDate = '~$arrPhotoData.timing`';
	if(currDate == '0000-00-00') {
		currDate = '';
	}
	$( "#datepicker1" ).datepicker();
  	$( "#datepicker1" ).datepicker('setDate', currDate);
    $( "#datepicker1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
  </script>
~include file="footer.tpl"`
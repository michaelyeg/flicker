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
	<form action="executeUploadFile.php" method="POST" class="form">
	<h1 class="grpHeading fleft">Upload Photo</h1>
	<h1 class="grpHeading fright"><input type="submit" class="colored try-it-btn" value="Save Photo"/></h1>
	
	<ul class="left-form" style="width:80%">
		<li>
			<input type="text" placeholder="Enter Subject" name="subject" id="subject" maxlength="128"/>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="subjectErr"></li>
		<li>
			<input type="text" placeholder="Where the Images were Clicked" name="place" id="place" maxlength="128"/>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="placeErr"></li>
		<li>
			<input type="text" placeholder="when the Images were Clicked" name="date" id="datepicker1" readonly/>
			<div class="clear"></div>
		</li>
		<li>
			<textarea class="txtArea" placeholder="Enter Description" name="description" id="description" maxlength="2048"></textarea>
			<div class="clear"></div>
		</li>
		<li>
			<input type="radio" name="permission" value="2" checked/>Private
			<input type="radio" name="permission" value="1"/>Public
			~foreach from = $arrGroupData key=index item=arrData` 
				<input type="radio" name="permission" value="~$arrData.group_id`"/>~$arrData.group_name`
			~/foreach`
		</li>
		<li class="error dispNone" id="descriptionErr"></li>
		<li id="imgPreview" class="imgPreview"></li>
		<div class="fileL dispNone" id="fileL"></div>
		<div class="clear"></div>
		<div class="msgAtchFile" id="msgAtchFile">
        	<input type="file" id="fileUpload" style="display:none" accept="image/jpg, image/gif">
            <a href="javascript:void(0);" id="fileUploadSelect"><span>Attach File</span></a>
	    </div>
		<div class="clear"> </div>
	</ul>
	</form>
</div>
<div class="grplist" style="border:0px">
	<form action="executeUploadFile.php" method="POST" class="form">
	<h1 class="grpHeading fleft">Upload Folder</h1>
	<h1 class="grpHeading fright"><input type="submit" class="colored try-it-btn" value="Save Folder"/></h1>
	<ul class="left-form" style="width:80%">
		<li>
			<input type="text" placeholder="Enter Subject" name="subject" id="subject" maxlength="128"/>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="subjectErr"></li>
		<li>
			<input type="text" placeholder="Where the Images were Clicked" name="place" id="place" maxlength="128"/>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="placeErr"></li>
		<li>
			<input type="text" placeholder="When the Images were Clicked" name="date" id="datepicker2" readonly/>
			<div class="clear"></div>
		</li>
		<li>
			<textarea class="txtArea" placeholder="Enter Description" name="description" id="description" maxlength="2048"></textarea>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="descriptionErr"></li>
		<li>
			<input type="radio" name="permission" value="2" checked/>Private
			<input type="radio" name="permission" value="1"/>Public
			~foreach from = $arrGroupData key=index item=arrData` 
				<input type="radio" name="permission" value="~$arrData.group_id`"/>~$arrData.group_name`
			~/foreach`
		</li>
		<div id="folderImg">
		</div>
		<div class="clear"></div>
		<div class="msgAtchFile">
        	<input type="file" id="folderUpload" style="display:none" webkitdirectory accept="image/jpg, image/gif"/>
            <a href="javascript:void(0);" id="folderUploadSelect"><span>Attach Folder</span></a>
	    </div>
		<div class="clear"> </div>
	</ul>
	</form>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
  $(function() {
	configureFileUpload();
	configureFolderUpload();
  	$( "#datepicker1" ).datepicker();
    $( "#datepicker1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    $( "#datepicker2" ).datepicker();
    $( "#datepicker2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
  </script>
~include file="footer.tpl"`
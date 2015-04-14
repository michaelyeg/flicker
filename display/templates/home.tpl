~include file="header.tpl"`
<div class="header">
	<h1>Welcome ~$fname` ~$lname`!</h1>
</div>
~if $msg eq 'gsuccess'`
	<h2>You have successfully Edited Group.</h2>
~else if $msg eq 'gerror'`
	<h2>Group name already exists. Please choose unique group name.</h2>	
~else if $msg eq 'dsuccess'`
	<h2>You have successfully Deleted Group.</h2>
~else if $msg eq 'psuccess'`
	<h2>You have successfully Uploaded Images.</h2>
~else if $msg eq 'dpsuccess'`
	<h2>You have successfully Deleted Photo.</h2>
~else if $msg eq 'upsuccess'`
	<h2>You have successfully Edited Images.</h2>	
~/if`
<p>Now you can share photos with your friends.</p>
<div class="form">
<div class="grplist">
	<h1 class="grpHeading">Group List</h1>
	~if $arrGroupData|@count eq 0`
		<div class="grpName">No Group Found</div>
	~else`
	~foreach from = $arrGroupData key=index item=arrData` 
	<div class="grpName">~$arrData.group_name`</div>
	<div class="grpAction"><a href="editGroup.php?id=~$arrData.group_id`">Edit</a> | <a href="deleteGroup.php?id=~$arrData.group_id`">Delete</a></div>              
	~/foreach`
	~/if`

	<h1 class="grpHeading">Most Viewed Photos</h1>
	~if $arrTopPhoto|@count eq 0`
		<div class="grpName">No Photo Found</div>
	~else`
	~foreach from = $arrTopPhoto key=index item=arrData` 
		<div class="grpName"><a href="viewImage.php?id=~$arrData.photo_id`"><img src="showImage.php?id=~$arrData.photo_id`&type=thumb"/></a></div>
	~/foreach`
	~/if`
</div>
<div class="grplist" style="border:0px">
	<h1 class="grpHeading">Your Photos</h1>
	~if $arrPhotoData|@count eq 0`
		<div class="grpName">No Photos Found</div>
	~else`
	~foreach from = $arrPhotoData key=index item=arrData` 
	<div class="grpName"><a href="viewImage.php?id=~$arrData.photo_id`"><img src="showImage.php?id=~$arrData.photo_id`&type=thumb"/></a></div>
	<div class="grpAction"><a href="viewImage.php?id=~$arrData.photo_id`">View</a> | <a href="editImage.php?id=~$arrData.photo_id`">Edit</a></div>              
	~/foreach`
	~/if`
</div>
</div>
~include file="footer.tpl"`
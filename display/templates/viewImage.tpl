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
	<h1 class="grpHeading">Photos Details</h1>
	<div class="grpName">Permission</div>
	<div class="grpAction">~$arrPhotoData.permission`</div>              
	<div class="grpName">Subject</div>
	<div class="grpAction">~if $arrPhotoData.subject eq ''` Not Available ~else` ~$arrPhotoData.subject` ~/if`</div> 
	<div class="grpName">Place</div>
	<div class="grpAction">~if $arrPhotoData.place eq ''` Not Available ~else` ~$arrPhotoData.place` ~/if`</div> 
	<div class="grpName">Timing</div>
	<div class="grpAction">~if $arrPhotoData.timing eq '0000-00-00'` Not Available ~else` ~$arrPhotoData.timing` ~/if`</div> 
	<div class="grpName">Description</div>
	<div class="grpAction">~if $arrPhotoData.description eq ''` Not Available ~else` ~$arrPhotoData.description` ~/if`</div>
	~if $arrPhotoData.owner_name eq $username`
	<div class="grpName"><a href="deletePhoto.php?id=~$arrPhotoData.photo_id`">Delete</a></div>
	<div class="grpAction"><a href="editImage.php?id=~$arrPhotoData.photo_id`">Edit</a></div>
	~/if`
</div>
</div>
~include file="footer.tpl"`
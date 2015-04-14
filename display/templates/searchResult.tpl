~include file="header.tpl"`
<div class="header">
	<h1>Welcome ~$fname` ~$lname`!</h1>
</div>
<p>Now you can share photos with your friends.</p>
<div class="form">
<div class="grplist" style="width:100%!important;">
	<h1 class="grpHeading" style="width:100%!important;">Search Result</h1>
	~if $arrPhotoData|@count eq 0`
		<div class="grpName">No Result Found</div>
	~else`
	~foreach from = $arrPhotoData key=index item=arrData` 
	    <div class="grpName" style="width:200px!important;"><a href="viewImage.php?id=~$arrData.photo_id`"><img src="showImage.php?id=~$arrData.photo_id`&type=thumb"/></a></div>         
	~/foreach`
	~/if`
</div>
</div>
~include file="footer.tpl"`
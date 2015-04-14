~include file="header.tpl"`
<div class="header" >
	<h1>Edit Group - ~$groupName`</h1>
</div>
~if $msg eq 'success'`
	<h2>You have successfully create new group.</h2>
~/if`
<form action="executeEditGroup.php" method="POST" onsubmit="return validateGroupForm();" class="form">
	<input type="hidden" name="groupId" value="~$groupId`" />
	<ul class="left-form">
		<li>
			<input type="text" placeholder="Enter Group Name" name="groupname" id="groupname" value="~$groupName`" required="required" maxlength="24"/>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="groupNameErr"></li>
		~foreach from = $arrAllUserData key=index item=arrData`	
			<input type="checkbox" value="~$arrData.user_name`" name="frnd[]" class="checkbox" ~if $arrData.user_name|in_array:$arrGroupMembers` checked ~/if`/>~$arrData.first_name` ~$arrData.last_name` (~$arrData.email`)
			<div class="clear"> </div>
		 ~/foreach`
		 <li class="error dispNone" id="frndErr"></li>
		<input type="submit" value="Update Group"> <a href="home.php">Cancel</a>
		<div class="clear"> </div>
	</ul>
</form>
</div>
~include file="footer.tpl"`
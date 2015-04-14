~include file="header.tpl"`
<div class="header" >
	<h1>Create Group</h1>
</div>
~if $msg eq 'success'`
	<h2>You have successfully create new group.</h2>
~else if $msg eq 'error'`
	<h2>Group Name already exists. Please choose a unique Group name</h2>
~/if`
<form action="executeCreateGroup.php" method="POST" onsubmit="return validateGroupForm();" class="form">
	<ul class="left-form">
		<li>
			<input type="text" placeholder="Enter Group Name" name="groupname" id="groupname" required="required" maxlength="24"/>
			<div class="clear"></div>
		</li>
		<li class="error dispNone" id="groupNameErr"></li>
		~foreach from = $arrAllUserData key=index item=arrData`                 
			<input type="checkbox" value="~$arrData.user_name`" name="frnd[]" class="checkbox" />~$arrData.first_name` ~$arrData.last_name` (~$arrData.email`)
			<div class="clear"> </div>
		 ~/foreach`
		 <li class="error dispNone" id="frndErr"></li>
		<input type="submit" value="Create Group">
		<div class="clear"> </div>
	</ul>
</form>
</div>
~include file="footer.tpl"`
~include file="header.tpl"`
<div class="header" >
			<h1>Login or Create a Free Account!</h1>
		</div>
		<p>Login or Create Account to share photos with your friends.</p>
			<form action="register.php" method="POST" onsubmit="return validateRegisterForm();">
				<ul class="left-form">
					<h2>New Account:</h2>
					<li>
						<input type="text" placeholder="Enter Username" name="username" id="username" required="required" maxlength="24"/>
						<div class="clear"></div>
					</li>
					<li class="error ~if $error eq ''` dispNone ~/if`" id="usernameErr">~$error`</li>
					<li>
						<input type="email" placeholder="Enter Email" name="email" id="email" value="~$email`" required="required" maxlength="28"/>
						<div class="clear"></div>
					</li>
					<li class="error dispNone" id="emailErr"></li>
					<li>
						<input type="password" placeholder="Enter Password" name="password" id="password" required="required" maxlength="24"/>
						<div class="clear"></div>
					</li>
					<li class="error dispNone" id="passwordErr"></li>
					<li>
						<input type="text" placeholder="Enter First Name" name="fname" id="fname" value="~$fname`" required="required" maxlength="24"/>
						<div class="clear"></div>
					</li>
					<li class="error dispNone" id="fnameErr"></li>
					<li>
						<input type="text" placeholder="Enter Last Name" name="lname" id="lname" value="~$lname`" required="required" maxlength="24"/>
						<div class="clear"></div>
					</li>
					<li class="error dispNone" id="lnameErr"></li>
					<li>
						<input type="text" placeholder="Enter Address" name="address" id="address" value="~$address`" required="required" maxlength="28"/>
						<div class="clear"></div>
					</li>
					<li class="error dispNone" id="addressErr"></li>
					<li>
						<input type="text" placeholder="Enter Phone Number" name="contact" id="contact" value="~$contact`" required="required" maxlength="10"/>
						<div class="clear"></div>
					</li>
					<li class="error dispNone" id="contactErr"></li>
						Clicking on submit, I accept Terms &amp; Conditions
						<div class="clear"> </div>
					</li>
					<input type="submit" value="Create Account">
					<div class="clear"> </div>
				</ul>
			</form>
			<form action="executeLogin.php" method="POST" onsubmit="return validateLoginForm();">
				<ul class="right-form">
					<h3>Login:</h3>
					<div>
						<li>
						<input type="text" placeholder="Enter Username" name="username" id="lusername" required="required" maxlength="24"/>
						<div class="clear"></div>
					</li>
					<li class="error dispNone" id="lusernameErr"></li>
					<li>
						<input type="password" placeholder="Enter Password" name="password" id="lpassword" required="required" maxlength="24"/>
						<div class="clear"></div>
					</li>
					<li class="error dispNone" id="lpasswordErr"></li>
					<li><input type="submit" value="Login" ><div class="clear"></div></li>
					</div>
					<div class="clear"> </div>
				</ul>
				<div class="clear"> </div>
			</form>
		</div>
	~include file="footer.tpl"`
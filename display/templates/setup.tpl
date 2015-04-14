~include file="header.tpl"`
<div class="header" >
	~if $msg eq 'Success'`
		<h1>The database has been created.</h1>
	~else`
		<h1>There was problem while setting up database. Error Encountered - ~$msg`</h1>
	~/if`
</div>
~if $msg eq 'Success'`
	<p>Please click <a href="index.php">here </a> to share the images.</p>
~else`
	<p>Please click <a href="setup.php">here </a> to start the setup again.</p>
~/if`
</div>>			
~include file="footer.tpl"`
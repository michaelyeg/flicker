function validateRegisterForm() {
	var error = false;
	var username = $.trim($('#username').val());
	var email = $.trim($('#email').val());
	var password = $.trim($('#password').val());
	var fname = $.trim($('#fname').val());
	var lname = $.trim($('#lname').val());
	var address = $.trim($('#address').val());
	var contact = $.trim($('#contact').val());

	if(username == '') {
		$('#usernameErr').removeClass('dispNone').html('Please Enter username');
		error = true;
	}
	else if(username.length > 24 || username.length < 6)  {
		$('#usernameErr').removeClass('dispNone').html('Please Enter valid username between 6 & 24 characters.');
		error = true;	
	}
	else if(!validateText(username)) {
		$('#usernameErr').removeClass('dispNone').html('Only (a-z,0-9,-,_) characters are allowed');
		error = true;
	}
	else {
		$('#usernameErr').addClass('dispNone').html('');
	}
	if(email == '') {
		$('#emailErr').removeClass('dispNone').html('Please Enter Email Id');
		error = true;
	}
	else if(email.length > 128 || email.length < 6)  {
		$('#emailErr').removeClass('dispNone').html('Please Enter valid Email id between 6 & 128 characters');
		error = true;	
	}
	else if(!validateEmail(email)) {
		$('#emailErr').removeClass('dispNone').html('Please Enter valid Email Id');
		error = true;
	}
	else {
		$('#emailErr').addClass('dispNone').html('');
	}
	if(password == '') {
		$('#passwordErr').removeClass('dispNone').html('Please Enter password');
		error = true;
	}
	else if(password.length > 24 || password.length < 6)  {
		$('#passwordErr').removeClass('dispNone').html('Please Enter valid password with character length between 6 & 24');
		error = true;	
	}
	else {
		$('#passwordErr').addClass('dispNone').html('');
	}
	if(fname == '') {
		$('#fnameErr').removeClass('dispNone').html('Please Enter First Name');
		error = true;
	}
	else if(fname.length > 24 || fname.length < 3)  {
		$('#fnameErr').removeClass('dispNone').html('Please Enter valid first name between 3 & 24 characters');
		error = true;	
	}
	else if(!validateName(fname)) {
		$('#fnameErr').removeClass('dispNone').html('Only alphabets characters are allowed');
		error = true;
	}
	else {
		$('#fnameErr').addClass('dispNone').html('');
	}
	if(lname == '') {
		$('#lnameErr').removeClass('dispNone').html('Please Enter Last Name');
		error = true;
	}
	else if(lname.length > 24 || lname.length < 3)  {
		$('#lnameErr').removeClass('dispNone').html('Please Enter valid last name between 3 & 24 characters');
		error = true;	
	}
	else if(!validateName(lname)) {
		$('#lnameErr').removeClass('dispNone').html('Only alphabests characters are allowed');
		error = true;
	}
	else {
		$('#lnameErr').addClass('dispNone').html('');
	}
	if(address == '') {
		$('#addressErr').removeClass('dispNone').html('Please Enter Address');
		error = true;
	}
	else if(address.length > 128 || address.length < 6)  {
		$('#addressErr').removeClass('dispNone').html('Please Enter valid Address between 6 & 128 characters');
		error = true;	
	}
	else {
		$('#addressErr').addClass('dispNone').html('');
	}
	if(contact == '') {
		$('#contactErr').removeClass('dispNone').html('Please Enter Phone Number');
		error = true;
	}
	else if(contact.length > 10 || contact.length < 10)  {
		$('#contactErr').removeClass('dispNone').html('Please Enter valid 10 digit Phone number');
		error = true;	
	}
	else if(!validateNumber(contact)) {
		$('#contactErr').removeClass('dispNone').html('Only Numericals are allowed');
		error = true;
	}
	else {
		$('#contactErr').addClass('dispNone').html('');
	}
	if(error) {
		return false;
	}
	return true;
}

function validateLoginForm() {
	var error = false;
	var username = $.trim($('#lusername').val());
	var password = $.trim($('#lpassword').val());

	if(username == '') {
		$('#lusernameErr').removeClass('dispNone').html('Please Enter username');
		error = true;
	}
	else if(username.length > 24 || username.length < 6)  {
		$('#lusernameErr').removeClass('dispNone').html('Please Enter valid username between 6 & 24 characters.');
		error = true;	
	}
	else if(!validateText(username)) {
		$('#lusernameErr').removeClass('dispNone').html('Only (a-z,0-9,-,_,space,comma) characters are allowed');
		error = true;
	}
	else {
		$('#lusernameErr').addClass('dispNone').html('');
	}
	if(password == '') {
		$('#lpasswordErr').removeClass('dispNone').html('Please Enter password');
		error = true;
	}
	else if(password.length > 24 || password.length < 6)  {
		$('#lpasswordErr').removeClass('dispNone').html('Please Enter valid password with character length between 6 & 24');
		error = true;	
	}
	else {
		$('#lpasswordErr').addClass('dispNone').html('');
	}
	if(error) {
		return false;
	}
	return true;
}

function validateGroupForm() {
	var error = false;
	var count = 0;
	var groupName = $.trim($('#groupname').val());
	if(groupName == '') {
		$('#groupNameErr').removeClass('dispNone').html('Please Enter Group Name');
		error = true;
	}
	else if(groupName.length > 24 || groupName.length < 6)  {
		$('#groupNameErr').removeClass('dispNone').html('Please Enter valid Group Name between 6 & 24 characters.');
		error = true;	
	}
	else if(!validateText(groupName)) {
		$('#groupNameErr').removeClass('dispNone').html('Only (a-z,0-9,-,_) characters are allowed');
		error = true;
	}
	else {
		$('#groupNameErr').addClass('dispNone').html('');
	}
	$('.checkbox').each(function() {
		if($(this).is(':checked')) {
			count++
		}
	})
	if(count == 0) {
		$('#frndErr').removeClass('dispNone').html('Please select atleast one Friend.');
		error = true;
	}
	if(error) {
		return false;
	}
	return true;;
}

function validateText(text) {
	var re = /^[a-zA-Z0-9-_]+$/;
    if(re.test(text)) {
    	return true;
    }
    return false;
}

function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(email)) {
    	return true;
    }
    return false;
}

function validateName(name) {
	var re = /^[a-zA-Z]+$/;
    if(re.test(name)) {
    	return true;
    }
    return false;
}

function validateNumber(num) {
	var re = /^[0-9]+$/;
    if(re.test(num)) {
    	return true;
    }
    return false;
}

/* File upload js */
function configureFileUpload() {
	var fileUpload = document.getElementById("fileUpload");
	var fileUploadSelect = document.getElementById("fileUploadSelect");
    fileUploadSelect.addEventListener("click", function (e) {
    	if (fileUpload) {
        	fileUpload.click();
        }
       	e.preventDefault(); // prevent navigation to "#"
    }, false);
    fileUpload.addEventListener("change", function () {
    	traverseFiles(this.files);
    }, false);
}

function traverseFiles (files) {
		if (typeof files !== "undefined") {
			for (var i=0; i<files.length; i++) {
				var date= new Date();
                var components = [date.getMinutes(),date.getSeconds(),date.getMilliseconds()];
                var random = components.join("");
				uploadAnyFile(files[i], random);
			}
		}
		else {
			alert("No support for the File API in this web browser");
			return false;
		}
}
function uploadAnyFile(file, random) {
	var reader, xhr, fileInfo, fileName = file.name, fileVal = file.name, idx = -1, fileExt = "";
	if ((idx = fileVal.lastIndexOf(".")) != -1) {
                fileExt = fileVal.substr(idx + 1).toLowerCase();
    }
    if(fileExt != 'jpg' && fileExt != 'gif') {
    	alert ('The file "'+fileName+'" is not supported. Please upload supported (jpg and gif) format.');
        return false;
    }
    if(parseFloat(file.size / 1024) > 64) {
    	alert('The file "'+fileName+'" exceeds the upload limit size (64kb)');
        return false;
    }
	if(fileName.length>15) {
		fileName = jQuery.trim(fileName).substring(0, 15).trim(this) + "...";
	}
   	$('#fileL').removeClass('dispNone').html('<div id="file'+random+'""><div class="fleft">'+fileName+'</div><div class="fright"><div class="progressBar" id=progressBar'+random+'"><div></div></div></div>');
	previewFile(file, 180);
	xhr = new XMLHttpRequest();
	var fd = new FormData();
	xhr.upload.addEventListener("progress", function (evt) {
		if (evt.lengthComputable) {
			progress((evt.loaded / evt.total) * 100, $('#progressBar'+random));
		}
	}, false);
	xhr.addEventListener("load", function () {
		$('#progressBar'+random).html('');
	}, false);
	xhr.open("post", "uploadFile.php", true);
	fd.append('testing', file);
	xhr.send(fd);
	xhr.onreadystatechange =  function() {
    		if (xhr.readyState == 4 && xhr.status == 200) {
      			var data = xhr.responseText;
				showMsgFile(data, random, fileName);
      		}
    	}
}

function showMsgFile(data, random, fileName) {
	eval( "data = " + data );
	if(data.status=='success') {
		$('#file'+random).html('<div class="fleft">'+fileName+'</div><div class="fright"><a href="javascript:void(0);" onclick="deleteMsgFile('+random+');">Delete</a><input type="hidden" name="fileId[]" value="'+data.filePath+'"/></div>');
		$('#msgAtchFile').addClass('dispNone');
	}
	else {
		$('#file'+random).remove();
		$('#fileL').addClass('dispNone');
		alert('Error while uploading File');
		return false;
	}
}

function progress(percent, element) {
	var progressBarWidth = percent * element.width() / 100;
	element.find('div').animate({ width: progressBarWidth }, 500);
}

function deleteMsgFile(random) {
    $('#file'+random).remove();
    $('#fileL').addClass('dispNone');
    $('#msgAtchFile').removeClass('dispNone');
    $('#imgPreview').html('');
}

function previewFile(file, size) {
    var reader = new FileReader();
    reader.onload = function (event) {
      var image = new Image();
      image.src = event.target.result;
      image.width = size; // a fake resize
      $('#imgPreview').html(image);
    };
    reader.readAsDataURL(file);
}

function configureFolderUpload() {
	var folderUpload = document.getElementById("folderUpload");
	var folderUploadSelect = document.getElementById("folderUploadSelect");
    folderUploadSelect.addEventListener("click", function (e) {
    	if (folderUpload) {
        	folderUpload.click();
        }
       	e.preventDefault(); // prevent navigation to "#"
    }, false);
    folderUpload.addEventListener("change", function (event) {
    	var files = event.target.files;
    	traverseFolderFiles(files);
    }, false);
}

function traverseFolderFiles(files) {
	if (typeof files !== "undefined") {
		for (var i=0; i<files.length; i++) {
			var date= new Date();
            var components = [date.getMinutes(),date.getSeconds(),date.getMilliseconds()];
            var random = components.join("");
            var fileVal = files[i].name;
            var fileSize = files[i].size;
            idx = fileVal.lastIndexOf(".");
            fileExt = fileVal.substr(idx + 1).toLowerCase();
    		if((fileExt == 'jpg' || fileExt == 'gif') && (parseFloat(fileSize / 1024) < 64)) {
    			uploadAnyFolderFile(files[i], random);
    		}
		}
	}
	else {
		alert("No support for the File API in this web browser");
		return false;
	}
}

function uploadAnyFolderFile(file, random) {
	var reader, xhr, fileInfo, fileName = file.name, idx = -1;
	if(fileName.length>15) {
		fileName = jQuery.trim(fileName).substring(0, 15).trim(this) + "...";
	}
   	$('#folderImg').append('<li id="imgPreview'+random+'" class="imgPreview"></li><div class="fileL" id="fileL'+random+'"><div class="fleft">'+fileName+'</div><div class="fright"><div class="progressBar" id=progressBar'+random+'"><div></div></div>');

   		//<div id="file'+random+'""><div class="fleft">'+fileName+'</div><div class="fright"><div class="progressBar" id=progressBar'+random+'"><div></div></div></div>');
	previewFolderFile(file,random,180);
	xhr = new XMLHttpRequest();
	var fd = new FormData();
	xhr.upload.addEventListener("progress", function (evt) {
		if (evt.lengthComputable) {
			progress((evt.loaded / evt.total) * 100, $('#progressBar'+random));
		}
	}, false);
	xhr.addEventListener("load", function () {
		$('#progressBar'+random).html('');
	}, false);
	xhr.open("post", "uploadFile.php", true);
	fd.append('testing', file);
	xhr.send(fd);
	xhr.onreadystatechange =  function() {
    		if (xhr.readyState == 4 && xhr.status == 200) {
      			var data = xhr.responseText;
				showFolderMsgFile(data, random, fileName);
      		}
    	}
}

function showFolderMsgFile(data, random, fileName) {
	eval( "data = " + data );
	if(data.status=='success') {
		$('#fileL'+random).html('<div class="fleft">'+fileName+'</div><div class="fright"><a href="javascript:void(0);" onclick="deleteFolderFile('+random+');">Delete</a><input type="hidden" name="fileId[]" value="'+data.filePath+'"/></div>');
	}
	else {
		$('#file'+random).remove();
		alert('Error while uploading File');
		return false;
	}
}

function previewFolderFile(file, random, size) {
    var reader = new FileReader();
    reader.onload = function (event) {
      var image = new Image();
      image.src = event.target.result;
      image.width = size; // a fake resize
      $('#imgPreview'+random).html(image);
    };
    reader.readAsDataURL(file);
}
function deleteFolderFile(random) {
    $('#imgPreview'+random).remove();
   	$('#fileL'+random).remove();
}

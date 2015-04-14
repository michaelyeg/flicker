Installation

1. Unzip folder in your web root directory (xampp/htdocs in case of windows, /var/www in case of linux, /Library/WebServer/Documents/ in case of Mac)

2. Edit config.php - change database configuration

3. Give chmod 777 permissions to folders - 'uploads', 'display/templates_c' and 'display/cache'

4. Open Google Chrome - http://localhost/flickr/setup.php

5. The login details for setup is - admin & admin



Folder Structure

uploads - files are uploaded here initially
static - css, js and images
plugins - Smarty Core Files
display - 
	templates - It has all the html files corresponsing to php files
	templates_c - Files created by Smarty Engine


MAJOR CHANGE - In smarty the left and right delimiters are { & } but they create issues with loops and javascript functions so we changed the delimiters to ~ & ` in plugins/Smarty.class.php



User Management Module

It helps user to register and login into the system.

1. Username should be unique
2. Length of username should be between 6 & 24
3. Username can have only alphanumeric characters along with dash(-) and hyphen(_)
4. Length of Email should be between 6 &128
5. Length of password should be between 6 & 24
6. Length of first and last name should be between 3 & 24
7. First and last Name can have only alphabatical characters
8. Length of Address should be between 6 & 128
9. Length of Contact number should be 10
10. Contact number can have only numerical characters 


Uploading Module

It helps user to upload the images into the system.

1. Only GIF & JPG files are allowed
2. File size should be less than 64 Kb
3. Only modern browsers will support uploading functionalities
4. Only Google Chrome will support folder upload functionality
5. Thumbnail of all the uploaded images are shown
6. All the images metadata - places, description, subject and time are optional.


Security Module

1. Only login users can upload images, edit images and delete images.
2. Only login users can create, edit and delete groups.
3. Each image can be assigned the permission - public, private or any single group created by owner
4. Only members of the group can see the images
5. Group name should be unique

Display Module

1. Shows the images and groups created by the user
2. Shows top 5 most viewed images
3. All the images are shown as thumbnail
4. When an thumbnail is clicked, original image with all details are shown
5. If owner of the image is same as user logged in, only then option to edit and delete is shown


Search Module

1. Only registered users can search the images
2. Images can be searched using keywords AND/OR dates
3. Images can be sort according to time - Most Recent First or Most Recent Last

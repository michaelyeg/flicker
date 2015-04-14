<?php

class databaseQuery {

	private $db;

	public function __construct() {
		$this->db = new PDO(DSN, DB_USER, DB_PASSWORD);
		$this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}

	public function setupDatabase() {
		try {
			$arrSql = array("CREATE TABLE `users` (`user_name` varchar(24) NOT NULL DEFAULT '',`password` varchar(24) DEFAULT NULL,`date_registered` date DEFAULT NULL,PRIMARY KEY (`user_name`))","CREATE TABLE `persons` (`user_name` varchar(24) NOT NULL DEFAULT '',`first_name` varchar(24) DEFAULT NULL,`last_name` varchar(24) DEFAULT NULL,`address` varchar(128) DEFAULT NULL,`email` varchar(128) DEFAULT NULL,`phone` char(10) DEFAULT NULL,PRIMARY KEY (`user_name`),UNIQUE KEY `email` (`email`),CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`))","CREATE TABLE `groups` (`group_id` int(11) NOT NULL DEFAULT '0',`user_name` varchar(24) DEFAULT NULL,`group_name` varchar(24) DEFAULT NULL,`date_created` date DEFAULT NULL,PRIMARY KEY (`group_id`),UNIQUE KEY `user_name` (`user_name`,`group_name`),CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`))","CREATE TABLE `group_lists` (`group_id` int(11) NOT NULL DEFAULT '0',`friend_id` varchar(24) NOT NULL DEFAULT '',`date_added` date DEFAULT NULL,`notice` varchar(1024) DEFAULT NULL,PRIMARY KEY (`group_id`,`friend_id`),KEY `friend_id` (`friend_id`),CONSTRAINT `group_lists_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),CONSTRAINT `group_lists_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_name`))","CREATE TABLE `images` (`photo_id` int(11) NOT NULL DEFAULT '0',`owner_name` varchar(24) DEFAULT NULL,`permitted` int(11) DEFAULT NULL,`subject` varchar(128) DEFAULT NULL,`place` varchar(128) DEFAULT NULL,`timing` date DEFAULT NULL,`description` varchar(2048) DEFAULT NULL,`thumbnail` blob,`photo` blob,PRIMARY KEY (`photo_id`),KEY `owner_name` (`owner_name`),KEY `permitted` (`permitted`),CONSTRAINT `images_ibfk_1` FOREIGN KEY (`owner_name`) REFERENCES `users` (`user_name`),CONSTRAINT `images_ibfk_2` FOREIGN KEY (`permitted`) REFERENCES `groups` (`group_id`))","CREATE TABLE `unique_views` (`photo_id` int(11) NOT NULL DEFAULT '0',`user_name` varchar(24) NOT NULL DEFAULT '',UNIQUE KEY `user_name` (`user_name`,`photo_id`),CONSTRAINT `unique_views_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`),CONSTRAINT `unique_views_ibfk_2` FOREIGN KEY (`photo_id`) REFERENCES `images` (`photo_id`))", "INSERT INTO groups values(1,null,'public', now());","INSERT INTO groups values(2,null,'private', now());");
			foreach($arrSql as $sql) {
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
			}
			return "Success";
		}
		catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	public function insertDataUsers($username,$password) {
		if($username == "" || $password == "") {
			throw new Exception("username or password is blank while registering");
		}
		else {
			try {
				$sql = "INSERT INTO ".DB_NAME.".users (user_name, password, date_registered) VALUES (:username, :password, now())";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->bindValue(':password', $password, PDO::PARAM_STR);
				$stmt->execute();
				$stmt->closeCursor();
			}
			catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}
	}

	public function insertDataPersons($username,$fname,$lname,$address,$email,$contact) {
		if($username=="" || $fname=="" || $lname=="" || $address=="" || $email=="" || $contact=="") {
			throw new Exception("Any of the $username,$fname,$lname,$address,$email,$contact is blank while registering");
		}
		else {
			try {
				$sql = "INSERT INTO ".DB_NAME.".persons (user_name, first_name, last_name,address,email,phone) VALUES (:username, :fname, :lname, :address,:email, :contact)";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->bindValue(':fname', $fname, PDO::PARAM_STR);
				$stmt->bindValue(':lname', $lname, PDO::PARAM_STR);
				$stmt->bindValue(':address', $address, PDO::PARAM_STR);
				$stmt->bindValue(':email', $email, PDO::PARAM_STR);
				$stmt->bindValue(':contact', $contact, PDO::PARAM_STR);
				$stmt->execute();
				$stmt->closeCursor();
			}
			catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}
	}

	public function getProfileData($username) {
		$arrData = array();
		if($username == "") {
			throw new Exception("Error retrieving profile data");	
		}
		else {
			try {
				$sql = "SELECT * FROM ".DB_NAME.".persons WHERE user_name = :username";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->execute();
				if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$arrData = $row;
				}
				$stmt->closeCursor();
				return $arrData;
			}
			catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}
	}

	public function getAllProfileData($username) {
		$arrData = array();
			try {
				$sql = "SELECT * FROM ".DB_NAME.".persons WHERE user_name != :username";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->execute();
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$arrData[] = $row;
				}
				$stmt->closeCursor();
				return $arrData;
			}
			catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
	}

	public function verifyUser($username,$password) {
		if($username == "" || $password == "") {
			throw new Exception("username or password is blank while login");
		}
		else {
			try {
				$sql = "SELECT user_name FROM ".DB_NAME.".users WHERE user_name = :username and password = :password";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->bindValue(':password', $password, PDO::PARAM_STR);
				$stmt->execute();
				$username = '';
				if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$username = $row['user_name'];
				}
				$stmt->closeCursor();
				return $username;
			}
			catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}	
	}

	public function createGroup($username,$groupname, $groupId) {
		if($username == "" || $groupname == "" || $groupId== "") {
			throw new Exception("username or groupId or groupname is blank while creating group");
		}
		else {
			try {
				$sql = "INSERT INTO ".DB_NAME.".groups (group_id, user_name, group_name, date_created) VALUES (:groupId, :username, :groupname, now())"; 
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->bindValue(':groupname', $groupname, PDO::PARAM_STR);
				$stmt->bindValue(':groupId', $groupId, PDO::PARAM_INT);
				$stmt->execute();
				$stmt->closeCursor();
			}
			catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}
	}

	public function insertGroupUserMapping($groupId, $username) {
		if($username == "" || $groupId == "") {
			throw new Exception("username or groupId is blank while creating group");
		}
		else {
			try {
				$sql = "INSERT INTO ".DB_NAME.".group_lists (group_id, friend_id, date_added) VALUES (:groupId, :username, now())"; 
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->bindValue(':groupId', $groupId, PDO::PARAM_INT);
				$stmt->execute();
				$stmt->closeCursor();
			}
			catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}
	}

	public function getGroupData($username) {
		$arrData = array();
		try {
			$sql = "SELECT * FROM ".DB_NAME.".groups WHERE user_name = :username";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData[] = $row;
			}
			$stmt->closeCursor();
			return $arrData;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function getGroupName($groupId, $username) {
		$groupName = '';
		try {
			$sql = "SELECT * FROM ".DB_NAME.".groups WHERE user_name = :username and group_id = :groupId";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->bindValue(':groupId', $groupId, PDO::PARAM_INT);
			$stmt->execute();
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$groupName = $row['group_name'];
			}
			$stmt->closeCursor();
			return $groupName;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function getGroupMembers($groupId) {
		$arrData = array();
		try {
			$sql = "SELECT * FROM ".DB_NAME.".group_lists WHERE group_id = :groupId";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':groupId', $groupId, PDO::PARAM_INT);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData[] = $row['friend_id'];
			}
			$stmt->closeCursor();
			return $arrData;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function updateGroup($groupName, $groupId) {
		try {
			$sql = "UPDATE ".DB_NAME.".groups SET group_name = :groupName WHERE group_id = :groupId";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':groupId', $groupId, PDO::PARAM_INT);
			$stmt->bindValue(':groupName', $groupName, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->closeCursor();
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function deleteGroupMembers($groupId) {
		try {
			$sql = "DELETE FROM ".DB_NAME.".group_lists WHERE group_id = :groupId";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':groupId', $groupId, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function deleteGroup($groupId) {
		try {
			$sql = "DELETE FROM ".DB_NAME.".groups WHERE group_id = :groupId";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':groupId', $groupId, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function insertPhotoDetails($photoId, $username, $permission=2, $subject=null, $place=null, $time='0000-00-00', $description=null, $thumbnailData, $photoData) {
		try {
				if($time == '') {
					$time = "0000-00-00";
				}
				$sql = "INSERT INTO ".DB_NAME.".images (photo_id, owner_name, permitted, subject, place, timing, description, thumbnail, photo) VALUES (:photoId, :username, :permission, :subject, :place, :time, :description, :thumbnail, :photo)"; 
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->bindValue(':permission', $permission, PDO::PARAM_INT);
				$stmt->bindValue(':subject', $subject, PDO::PARAM_INT);
				$stmt->bindValue(':place', $place, PDO::PARAM_STR);
				$stmt->bindValue(':time', $time);
				$stmt->bindValue(':description', $description, PDO::PARAM_STR);
				$stmt->bindValue(':thumbnail', $thumbnailData);
				$stmt->bindValue(':photo', $photoData);
				$stmt->execute();
				$stmt->closeCursor();
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function getPhotoDetails($username) {
		try {
			$sql = "SELECT photo_id, owner_name, permitted, subject, place, timing, description FROM ".DB_NAME.".images where owner_name = :username";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData[] = $row;
			}
			$stmt->closeCursor();
			return $arrData;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function getImage($photoId) {
		try {
			$sql = "SELECT thumbnail,photo FROM ".DB_NAME.".images where photo_id = :photoId";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':photoId', $photoId, PDO::PARAM_STR);
			$stmt->execute();
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData = $row;
			}
			$stmt->closeCursor();
			return $arrData;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function getPhotoDetailsById($photoId) {
		try {
			$sql = "SELECT * FROM ".DB_NAME.".images where photo_id = :photoId";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':photoId', $photoId, PDO::PARAM_STR);
			$stmt->execute();
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData = $row;
			}
			$stmt->closeCursor();
			return $arrData;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function deletePhoto($photoId, $username) {
		try {
			$sql = "DELETE FROM ".DB_NAME.".images WHERE photo_id = :photoId AND owner_name = :user_name";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->closeCursor();
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function updatePhotoDetails($photoId, $username, $permission, $subject, $place, $time, $description) {
		try {
				if($time == '') {
					$time = "0000-00-00";
				}
				$sql = "UPDATE ".DB_NAME.".images SET permitted=:permission, subject=:subject, place=:place, timing=:time, description=:description WHERE photo_id=:photoId AND owner_name = :username"; 
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
				$stmt->bindValue(':username', $username, PDO::PARAM_STR);
				$stmt->bindValue(':permission', $permission, PDO::PARAM_INT);
				$stmt->bindValue(':subject', $subject, PDO::PARAM_INT);
				$stmt->bindValue(':place', $place, PDO::PARAM_STR);
				$stmt->bindValue(':time', $time);
				$stmt->bindValue(':description', $description, PDO::PARAM_STR);
				$stmt->execute();
				$stmt->closeCursor();
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function findUsersGroup($username) {
		$arrData = array();
		try {
			$sql = "SELECT group_id FROM ".DB_NAME.".group_lists where friend_id = :username";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData[] = $row['group_id'];
			}
			$stmt->closeCursor();
			return $arrData;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function getSearchResult($strGroupIds, $keywords, $condition, $from, $to, $username, $sorting) {
		try {
			$where = "(subject like '%".$keywords."%' OR place like '%".$keywords."%' OR description like '%".$keywords."%')";
			if ($condition == 'or') {
				$where = $where. " OR (timing >= '".$from."' AND timing <= '".$to."')";
			}elseif($condition == 'and') {
				$where = $where. " AND (timing >= '".$from."' AND timing <= '".$to."')";
			}
			$where = $where. " AND (permitted IN (".$strGroupIds.") OR owner_name = '".$username."')";
			if($sorting!='') {
				$where = $where. " ORDER BY timing $sorting";
			}
			$sql = "SELECT photo_id, owner_name, permitted, subject, place, timing, description FROM ".DB_NAME.".images WHERE $where";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData[] = $row;
			}
			$stmt->closeCursor();
			return $arrData;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function isImageAlreadySeen($username, $photoId) {
		$arrData = array();
		try {
			$sql = "SELECT * FROM ".DB_NAME.".unique_views where photo_id = :photoId AND user_name = :username";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
			$stmt->execute();
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData = $row;
			}
			$stmt->closeCursor();
			return count($arrData);
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function insertUniqueView($username, $photoId) {
		try {
			$sql = "INSERT INTO ".DB_NAME.".unique_views (photo_id, user_name) VALUES (:photoId , :username)";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function getTopPhoto() {
		$arrData = array();
		try {
			$sql = "SELECT photo_id, count(photo_id) as views FROM ".DB_NAME.".unique_views group by photo_id order by views limit 5";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData[] = $row;
			}
			$stmt->closeCursor();
			return $arrData;
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function isGroupNameUnique($username, $groupname) {
		$arrData = array();
		try {
			$sql = "SELECT * FROM ".DB_NAME.".groups WHERE user_name = :username AND group_name = :groupname";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->bindValue(':groupname', $groupname, PDO::PARAM_STR);
			$stmt->execute();
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData = $row;
			}
			$stmt->closeCursor();
			return count($arrData);
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function isUsernameUnique($username) {
		$arrData = array();
		try {
			$sql = "SELECT * FROM ".DB_NAME.".users WHERE user_name = :username";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->execute();
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$arrData = $row;
			}
			$stmt->closeCursor();
			return count($arrData);
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}
}

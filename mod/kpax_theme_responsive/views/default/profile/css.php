<?php
/**
 * Elgg Profile CSS
 * 
 * @package Profile
 */
?>
/* ***************************************
	Profile
*************************************** */
.profile {
	float: left;
	margin-bottom: 15px;
}
.profile .elgg-inner {
	margin: 0 5px;
	border: 2px solid #ddd;
}
#profile-details {
	padding: 15px;
}


/*** ownerblock ***/
#profile-owner-block {
	width: 200px;
	float: left;
	background-color: #eee;
	padding: 15px;
  	border-right: 2px solid #ddd;
}
#profile-owner-block .large {
	margin-bottom: 10px;
}
#profile-owner-block a.elgg-button-action {
	margin-bottom: 5px;
	display: table;
}
.profile-content-menu a {
	display: block;
	border-radius: 3px;
	background: #fff;
  	border: 1px solid #bbb;
	padding: 5px 15px;
	margin: 1px 0;
}
.profile-content-menu a:hover {
	background-color: #28d;
  	border-color: #06b;
	color: #fff;
	text-decoration: none;
}
.profile-admin-menu {
	display: none;
}
.profile-admin-menu-wrapper {
  	margin-top: 10px;
	background-color: #fff;
	border-radius: 3px;
}
.profile-admin-menu-wrapper a {
	display: block;
	border-radius: 3px;
	background-color: #fff;
	padding: 5px 15px;
	color: #f00;
}
.profile-admin-menu-wrapper a:hover {
	color: #000;
}


/*** profile details ***/
#profile-details .odd {
	background-color: #eee;
	margin: 0 0 5px;
	padding: 3px 10px;
}
#profile-details .even {
	background-color: transparent;
	margin: 0 0 5px;
	padding: 3px 10px;
}
.profile-aboutme-title {
	background-color: #eee;
	margin: 0;
	padding: 3px 10px;
}
.profile-aboutme-contents {
	padding: 3px 10px;
}
.profile-banned-user {
	border: 2px solid #f00;
	padding: 5px 10px;
}

/* File upload */
.dropfile-inactive {
	margin-top:2em;
	max-width:200px; 
	height:200px; 
	border:3px dashed gray;
	color:#333;
	padding:10px;
}
.dropfile-init:before {
	content: '<?php echo elgg_echo("kpax:dragdrop") ?>';
}
.dropfile-dragover {
	border:3px dashed orange;
}
.elgg-form-avatar-upload img {
	position:relative;
	left:150px;
	top:150px;
}
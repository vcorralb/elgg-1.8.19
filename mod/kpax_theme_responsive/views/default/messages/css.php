<?php
/**
 * Elgg Messages CSS
 * 
 * @package ElggMessages
 */
?>

.messages-container {
	min-height: 200px;
}
.message.unread a {
	color: #f00;
}
.messages-buttonbank {
	text-align: right;
}
.messages-buttonbank input {
	margin-left: 10px;
}


/*** message metadata ***/
.messages-owner {
	float: left;
	width: 20%;
	margin-right: 2%;
}
.messages-subject {
	float: left;
	width: 55%;
	margin-right: 2%;
}
.messages-timestamp {
	float: left;
	width: 14%;
	margin-right: 2%;
}
.messages-delete {
	float: left;
	width: 5%;
}


/*** topbar icon ***/
.messages-new {
	position: absolute;
	color: #fff;
	background-color: #f00;
	border-radius: 10px;
	box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.5);
	text-align: center;
	top: -5px;
	left: 25px;
	min-width: 18px;
	height: 18px;
	font-size: 11px;
	font-weight: bold;
}

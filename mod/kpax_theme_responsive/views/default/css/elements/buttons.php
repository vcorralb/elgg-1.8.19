<?php
/**
 * CSS buttons
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* **************************
	BUTTONS
************************** */

/* Base ********************/
.elgg-button {
	font: bold 0.9em/1.5em "Helvetica Neue", Arial, Helvetica, sans-serif;
	border-radius: 3px;
	width: auto;
	padding: 5px 15px;
	cursor: pointer;
    text-decoration: none;
	box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.5);
  	color: #222;
	text-shadow: 0px 1px 1px #fff;
  	border: 1px solid #888;
	background: #fff url(<?php echo elgg_get_site_url(); ?>mod/themekPAX/graphics/button.png) repeat-x left top;
	-webkit-transition:all ease .4s;
 	transition:all ease .4s;
}
.touch .elgg-button {
	font-size:1.3em;
}
.elgg-button:hover {
	-ms-transform:scale(1.2);
	-webkit-transform:scale(1.2);
	transform:scale(1.2);
	color:#222;
  	border: 1px solid #ff4500;
	text-decoration: none;
}
.elgg-button:active {
	background: url(<?php echo elgg_get_site_url(); ?>mod/themekPAX/graphics/button-active.png) left bottom;
  	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
  	border-color:#77E;
}
.elgg-button.elgg-state-disabled,
.elgg-button.elgg-state-disabled:hover {
	background: #999;
	border-color: #999;
	cursor: default;
	color: #222;
	text-shadow: 0px 1px 1px #fff;
	box-shadow: none;
}


/* Submit ********************/
.elgg-button-submit {
	color: #fff;
	text-shadow: 0px 1px 1px #000;
	text-decoration: none;
  	border-color: #048;
	background-color: #28f;
}
.elgg-button-submit:hover {
  	color:white;
  	border-color: #048;
  	margin-left:1px;
  	-ms-transform:scale(1.1);
  	-webkit-transform:scale(1.1);
	transform:scale(1.1);
	-ms-transform-origin:-30px top;
	-webkit-transform-origin:-30px top;
	transform-origin:-30px top;
}


/* Cancel ********************/
.elgg-button-cancel, 
.elgg-button-cancel:hover {
	color: #fff;
	text-shadow: 0px 1px 1px #000;
	text-decoration: none;
	border-color: #222;
	background-color: #666;
}

.elgg-button-cancel:hover {
  border-color: #000;
	background-color: #444;
}


/* Delete ********************/
.elgg-button-delete,
.elgg-button-delete:hover {
	color: #fff;
	text-shadow: 0px 1px 1px #000;
	text-decoration: none;
	border-color: #800;
	background-color: #d22;
}

.elgg-button-delete:hover {
  	border-color: #600;
	background-color: #b00;
}


/* Special ********************/
.elgg-button-special,
.elgg-button-special:hover {
	color: #fff;
	text-shadow: 0px 1px 1px #000;
	text-decoration: none;
	border-color: #080;
	background-color: #2d3;
}

.elgg-button-special:hover {
  	border-color: #060;
	background-color: #0c1;
}


/* Dropdown ********************/
.elgg-button-dropdown,
.elgg-button-dropdown:hover,
.elgg-button-dropdown.elgg-state-active {
  	border: 0;
}

.elgg-button-dropdown:after {
	content: " \25BC ";
	font-size: smaller;
}

.elgg-button-dropdown.elgg-state-active {
	background: #ccc;
  	border-radius:0;
}

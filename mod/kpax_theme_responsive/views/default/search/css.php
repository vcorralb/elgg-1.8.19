<?php
/**
 * Elgg Search css
 * 
 */
?>

/**********************************
Search plugin
***********************************/
.elgg-search-header {
	bottom: 10px;
	position: absolute;
	right: 4%;
 	z-index: 1;
 	-webkit-transition:all ease 3s;
 	transition:all ease 3s;
}
.elgg-search input[type=submit] {
	display: none;
}
.elgg-search input[type=text] {
	width:175px;
	height: 20px;
	border-radius: 5px;
	border: 1px solid rgba(0, 0, 0, 0.25);
	color: #fff;
    font-size: 1em;
	font-weight: bold;
    line-height: 1.5em;
	padding: 3px 15px;
	background-color: rgba(0, 0, 0, 0.25);
}
.elgg-search input[type=text]:focus, .elgg-search input[type=text]:active {
	border:2px solid red;
	background: rgba(0, 0, 0, 0.25) url(<?php echo elgg_get_site_url(); ?>mod/themekPAX/graphics/sprites.png) no-repeat 0 -935px;
	padding-left:20px;
}
.search-list li {
	padding: 5px 0 0;
}
.search-heading-category {
	margin-top: 20px;
	color: #666;
}
.search-highlight {
	background-color: #bbdaf7;
}
.search-highlight-color1 {
	background-color: #bbdaf7;
}
.search-highlight-color2 {
	background-color: #A0FFFF;
}
.search-highlight-color3 {
	background-color: #FDFFC3;
}
.search-highlight-color4 {
	background-color: #ccc;
}
.search-highlight-color5 {
	background-color: #4690d6;
}

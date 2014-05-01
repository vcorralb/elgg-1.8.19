<?php
/**
 * Page Layout
 *
 * Contains CSS for the page shell and page layout
 *
 * Default layout: max 1100px wide, centered. Used in default page shell
 * Breakpoint: 700px
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	PAGE LAYOUT
*************************************** */
/***** DEFAULT LAYOUT ******/
/* the width is on the page rather than topbar to handle small viewports */
.elgg-page-default {
	min-width:400px;
	_width: 990px;  	/*IE6*/
	background:  url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAGCAYAAADgzO9IAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MjU4QTREMDEwREQ5MTFFMDlCOUNCOTBBRjFCODM4Q0UiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MjU4QTREMDIwREQ5MTFFMDlCOUNCOTBBRjFCODM4Q0UiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoyNThBNENGRjBERDkxMUUwOUI5Q0I5MEFGMUI4MzhDRSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoyNThBNEQwMDBERDkxMUUwOUI5Q0I5MEFGMUI4MzhDRSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PrsIN4gAAAARSURBVHjaYmDADrgGVBAgwAAR0AA9WfZ8WAAAAABJRU5ErkJggg==);
}
.elgg-page-default .elgg-page-header > .elgg-inner {
	height: 150px;
	margin: 0 auto;

}
.elgg-page-default .elgg-page-body > .elgg-inner {
	max-width: 1100px;
	_width:990px; /*IE6*/
	margin: .8em auto;
	padding:0 2em;
}
.elgg-page-default .elgg-page-footer > .elgg-inner {
	_width: 980px; /*IE6*/
	margin: 0 auto;
	padding: 10px 15px;
}
.elgg-page-body .elgg-inner {
	background: white;
}

/***** TOPBAR ******/
.elgg-page-topbar {
	background: #444 url(<?php echo elgg_get_site_url(); ?>mod/themekPAX/graphics/topbar.png) repeat-x bottom left;
	border-bottom: 1px solid #000;
	position: relative;
	z-index: 9000;
}
.elgg-page-topbar > .elgg-inner {
  padding: 8px 0px 6px 0px;
  _width: 990px;
  margin: auto;
}


/***** PAGE MESSAGES ******/
.elgg-system-messages {
	position: fixed;
	top: 40px;
	right: 20px;
	max-width: 500px;
	z-index: 2000;
}
.elgg-system-messages li {
	margin-top: 10px;
}
.elgg-system-messages li p {
	margin: 0;
}


/***** PAGE HEADER ******/
.elgg-page-header {
	position: relative;
	background: url(<?php echo elgg_get_site_url(); ?>mod/themekPAX/graphics/header-gradients.png) no-repeat 200px 0, url(<?php echo elgg_get_site_url(); ?>mod/themekPAX/graphics/header.png) repeat-x, #000;
}
.elgg-page-header > .elgg-inner {
	position: relative;
	-webkit-transition:all ease 3s;
 	transition:all ease 3s;
}


/***** PAGE BODY LAYOUT ******/
.elgg-layout {
	min-height: 360px;
}
.elgg-layout-one-sidebar {

}
.elgg-layout-two-sidebar {
	
}
.elgg-layout-error {
	margin-top: 20px;
}
.elgg-sidebar {
	position: relative;
	padding: 20px 15px;
	float: right;
	width: 200px;
	margin: 0;
}
.elgg-sidebar-alt {
	position: relative;
	padding: 20px 15px;
	float: left;
	width: 150px;
	margin: 0;
}
.elgg-main {
	position: relative;
	min-height: 360px;
	padding: 15px;
}
.elgg-main > .elgg-head {
	margin-bottom: 10px;
}


/***** PAGE FOOTER ******/
.elgg-page-footer {
	position: relative;
}
.elgg-page-footer {
	color: #aaa;
	text-shadow: 0px 1px 1px #000;
  	height: 100px;
}
.elgg-page-footer a {
	color: #888;
  text-decoration: none;
}
.elgg-page-footer a:hover {
	color: #eee;
}

.elgg-page-footer > .elgg-inner {
	height: 65px;
	background: #222 url(<?php echo elgg_get_site_url(); ?>mod/themekPAX/graphics/footer.png) 20px 0 no-repeat;
}



/**** Afegits César * LoginRequired kPAX ****/

.coslogin {
	width: 300px;
	float: right;
}
.loginrequired-index .content {
	width: 51%;
	float: left;
	text-align: right;
}
.loginrequired-index h2 {
	font-size: 4.2em;
	padding: .3em 0;
	line-height:.9em;
}
.loginrequired-index p {
	font-size: 1.9em;
	line-height: 1.1em;
}

@media screen and (max-width:700px) {
	.elgg-page-default .elgg-page-header {
		background-position:0 -48px;
	}
	.elgg-page-default .elgg-page-header > .elgg-inner {
		height:100px;
	}	
	.elgg-menu-topbar-alt {
		width:60%;
	}
	.elgg-menu-topbar-alt li {
		height:1.2em;
		width:30%;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	.elgg-menu-topbar-alt li:hover span {
		display:none;
	}
	.elgg-heading-site {
		font-size:2em;
		margin:-16px;
		padding-left:50px;
	}
	.elgg-heading-site:after {
		top:13px;
		left:-75px;
		font-size:.15em;
	}
	.elgg-inner .elgg-search .search-input {
		width:150px;
		-ms-transform:scale(1.25);
		-webkit-transform:scale(1.25);
		transform:scale(1.25);
	}
	.elgg-inner .elgg-search-header {
		bottom:70px;
	}
	.elgg-col-1of2, .pvm {
		width:100%;
	}
	.elgg-module-featured {
		box-shadow:none;
	}
	.elgg-module-featured > .elgg-head * {
		text-shadow:none;
	}
	.elgg-layout-one-sidebar .elgg-sidebar {
		width:100px;	
	}
	.elgg-layout-one-sidebar .elgg-image img {
		width:60%;
		margin:20%;
	}
	.elgg-menu-entity-default + h3 {
		margin-top:40px;
	}
	.elgg-layout-one-sidebar .elgg-menu-filter {
		min-width:220px;
	}
	.loginrequired-index .content {
		float:none;
		width:100%;
		margin-bottom:2em;
	}
	.loginrequired-index h2 {
		font-size:3.5em;
	}
	.loginrequired-index p {
		font-size:1.7em;
	}
	.coslogin {
		float:none;
		margin:0 auto;
	}
}
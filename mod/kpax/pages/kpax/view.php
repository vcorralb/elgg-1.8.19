<?php

/**
 * View a bookmark
 *
 * @package ElggBookmarks
 */
$kpax = get_entity(get_input('guid'));

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;


//NOU
$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);

$game = $objKpax->getGame($kpax['guid'], $_SESSION["campusSession"]);

/* Get categories, platforms and skills */
$categories = $objKpax->getCategories($_SESSION["campusSession"]);
$platforms = $objKpax->getPlatforms($_SESSION["campusSession"]);
$skills = $objKpax->getSkills($_SESSION["campusSession"]);

$cats = array();
$plats = array();
$skillss = array();

foreach($categories as $cat)
{
	$cats[$cat->idCategory] = $cat->name;
}
foreach($platforms as $plat)
{
	$plats[$plat->idPlatform] = $plat->name;
}
foreach($skills as $skill)
{
	$skillss[$skill->idSkill] = $skill->name;
}

$catview = "";
$platview = "";
$skillview = "";
$ageview = "";
if($game->idCategory != 0)
	$catview = $cats[$game->idCategory];
if($game->idPlatform != 0)
	$platview = $plats[$game->idCategory];
if($game->idSkill != 0)
	$skillview = $skillss[$game->idCategory];
if($game->minimumAge != 0)
	$minimumageview = $game->minimumAge;

////

$title = $kpax->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($kpax, array('full_view' => true));

$content .= "<br/>".elgg_echo('kpax:category').": ".$catview."<br/>";
$content .= elgg_echo('kpax:platform').": ".$platview."<br/>";
$content .= elgg_echo('kpax:skill').": ".$skillview."<br/>";
$content .= elgg_echo('kpax:minimumage').": ".$minimumageview." ".elgg_echo('kpax:age')."<br/>";

$content .= elgg_view_comments($kpax);

$body = elgg_view_layout('content', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
    'header' => '',
        ));

echo elgg_view_page($title, $body);
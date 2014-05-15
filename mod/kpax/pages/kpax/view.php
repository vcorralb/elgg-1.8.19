<?php

/**
 * View a bookmark
 *
 * @package ElggBookmarks
 */
$kpax = get_entity(get_input('guid'));


//IMPMORTANT: AIXÒ NO FUNCIONA!
$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;


//NOU
$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);

//NOVA FORMA DE EXTREURE ID!
$urlVector = explode("/",$_SERVER['REQUEST_URI']);
$idGame = $urlVector[count($urlVector)-1];

$game = $objKpax->getGame($idGame, $_SESSION["campusSession"]);

/* Get categories, platforms and skills */
$categories = $objKpax->getCategories($_SESSION["campusSession"]);
$platforms = $objKpax->getPlatforms($_SESSION["campusSession"]);
$skills = $objKpax->getSkills($_SESSION["campusSession"]);

/* Get tags*/
//$tags = $objKpax->getTagsGame($_SESSION["campusSession"],$idGame);

/* Get metadata */
//$metadatas = $objKpax->getMetaDatasGame($_SESSION["campusSession"],$idGame);

/* Get similar games */
$similarGameList = $objKpax->getListSimilarGames($idGame, $_SESSION["campusSession"]);

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
$tagsview = "";
$metadatasview = "<br /><ul style='list-style-type: disc; margin-left: 50px'>";
if($game->idCategory != 0)
	$catview = $cats[$game->idCategory];
if($game->idPlatform != 0)
	$platview = $plats[$game->idPlatform];
if($game->idSkill != 0)
	$skillview = $skillss[$game->idSkill];
foreach($game->tags as $tag){
	if ($tag != null){
		$tagsview .= $tag->tag." ";
	}
}

foreach($game->metadatas as $metadata){
	if ($metadata != null){
		$metadatasview .= "<li>".$metadata->keyMeta.": ";
		$metadatasview .= $metadata->valueMeta."</li>";
	}
}
$metadatasview .= "</ul>";

////

//$title = $kpax->title;
$title = $game->name;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($kpax, array('full_view' => true));

$content .= elgg_echo('kpax:name').": ".$game->name."<br/>";
$content .= elgg_echo('kpax:descripgame').": ".$game->descripGame."<br/>";

$content .= "<br/>".elgg_echo('kpax:category').": ".$catview."<br/>";
$content .= elgg_echo('kpax:platform').": ".$platview."<br/>";
$content .= elgg_echo('kpax:skill').": ".$skillview."<br/>";

$content .= elgg_echo('kpax:tags').": ".$tagsview."<br />";

$content .= elgg_echo('kpax:metadatas').": ".$metadatasview."<br />";

$content .= elgg_echo('kpax:urlImage').": ".$game->urlImage."<br />";

$content .= "<br /><b>".elgg_echo('kpax:similarGames')."</b><br />";

/* Tags from similar games */
$tagsview = "";


foreach ($similarGameList as $similarGame) {
	foreach($similarGame->tags as $tag){
		if ($tag != null){
			$similargametagsview .= $tag->tag." ";
		}
	}
	$content .= elgg_echo('kpax:name').": ".$similarGame->name."<br />";
	$content .= elgg_echo('kpax:descripGame').": ".$similarGame->descripGame."<br />";
	$content .= elgg_echo('kpax:tags').": ".$similargametagsview."<br />";
	$content .= elgg_echo('kpax:urlImage').": ".$similarGame->urlImage."<br />";
}

$content .= elgg_view_comments($kpax);

$body = elgg_view_layout('content', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
    'header' => '',
        ));

echo elgg_view_page($title, $body);
<?php

/**
 * View a bookmark
 *
 * @package ElggBookmarks
 */
//$kpax = get_entity(get_input('guid'));


//IMPORTANT: AIXÒ NO FUNCIONA!
//$page_owner = elgg_get_page_owner_entity();

$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);

//New process to extract id's game
$urlVector = explode("/",$_SERVER['REQUEST_URI']);
$idGame = $urlVector[count($urlVector)-1];

/* Call kPAX */
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


//$title = $kpax->title;
//$title = $game->name;

//Breadcrumb
elgg_push_breadcrumb($game->name);

//$content = elgg_view_entity($kpax, array('full_view' => true));

$content.= "<div class='ficha_juego'>";
	$content.= "<div class='ficha_juego_izquierda'>";
		$content.= "<div class='juego'>";
			$content.= "<div class='juego_foto_wrapper'>";
				$content.="<div class='juego_foto'>";
					$content.="<img src='".$game->urlImage."' alt='".$game->name."' width='140' height='160' />";
				$content.="</div>";
			$content.= "</div>";
			$content.= "<div class='juego_texto'>";
				$content.= "<h2>".$game->name."</h2>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:description').$game->descripGame."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:category').": ".$catview."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:platform').": ".$platview."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:skill').": ".$skillview."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:tags').": ".$tagsview."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:metadatas').": ".$metadatasview."</p>";
				$content.= "</div>";
			$content.= "</div>";
		$content.= "</div>";
		$content.= "<div class='doscol'>";
$content.="<h3>".elgg_echo('kpax:similarGames')."</h3>";
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
		$content.= "</div>";
		$content.= "<div class='doscol'>";
			$content.="<h3>".elgg_echo('kpax:comments')."</h3>";
		$content.= "</div>";
	$content.= "</div>";
	$content.= "<div class='ficha_juego_derecha'>";	
		$content.="<h3>".elgg_echo('kpax:gamestatisticssocialnetworks')."</h3>";
		$content.="<div class='clearer'></div>";
	$content.= "</div>";

$content.= "</div>";

$content.="<div class='clearer'></div>";

//$content .= elgg_view_comments($kpax);

$body = elgg_view_layout('one_column', array(
    'content' => $content,
    'title' => ''/*$title*/,
    'filter' => '',
    'header' => '',
        ));

/* CSS include */
$css_url = 'mod/kpax/views/default/css/elements/game.css';
elgg_register_css('game', $css_url);
elgg_load_css('game');

echo elgg_view_page($title, $body);
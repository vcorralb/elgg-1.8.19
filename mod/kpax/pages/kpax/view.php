<?php

$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);

//Process to extract id's game
$urlVector = explode("/",$_SERVER['REQUEST_URI']);
$idGame = $urlVector[count($urlVector)-1];

/* Call kPAX */
$game = $objKpax->getGame($idGame, $_SESSION["campusSession"]);

/* Get categories, platforms and skills */
$categories = $objKpax->getCategories($_SESSION["campusSession"]);
$platforms = $objKpax->getPlatforms($_SESSION["campusSession"]);
$skills = $objKpax->getSkills($_SESSION["campusSession"]);

/* Get similar games */
$similarGameList = $objKpax->getListSimilarGames($idGame, $_SESSION["campusSession"]);

//Capture category, platform and skill names
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

//Render categories, platforms, skills, tags and metadatas
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

//Add breadcrumb game
elgg_push_breadcrumb($game->name);

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
					$content.= "<p>".elgg_echo('kpax:game:description').": ".$game->descripGame."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:game:category').": ".$catview."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:game:platform').": ".$platview."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:game:skill').": ".$skillview."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:game:tag').": ".$tagsview."</p>";
				$content.= "</div>";
				$content.= "<div class='texto_descripcion'>";
					$content.= "<p>".elgg_echo('kpax:game:metadata').": ".$metadatasview."</p>";
				$content.= "</div>";
			$content.= "</div>";
			$content.="<input id='play_button' name='play_button' type='submit' value='".elgg_echo('kpax:play')."' />";
		$content.= "</div>";
		$content.= "<div class='doscol'>";
			$content.= "<h3>".elgg_echo('kpax:similarGames')."</h3>";
			$content.= "<div class='contenedor_juegos'>";
			foreach ($similarGameList as $similarGame) {
				foreach($similarGame->tags as $tag){
					if ($tag != null){
						$similargametagsview .= $tag->tag." ";
					}
				}
				
				$content.= "<div class='cuadro_juego'>";
					$content.= "<a class= 'juego_link' href='".$similarGame->idGame."'></a>";
					$content.= "<div class='juego_foto'>";
						$content.= "<a class= 'juego_link' href='".$similarGame->idGame."'>";
							$content.= "<img src='".$similarGame->urlImage."' alt='".$similarGame->name."' width='140' height='160' />";
							$content.= "<span class='transicion' />";	
						$content.= "</a>";
					$content.= "</div>";
					$content.= "<div class='juego_texto'>";
						$content.= "<a class= 'juego_link' href='".$similarGame->idGame."'></a>";
						$content.= "<h2><a href='".$similarGame->idGame."'>".$similarGame->name."<span class='final_parrafo final_parrafo_titulo'></span></a>";
							
						$content.= "</h2>";
						$content.= "<div class='texto_descripcion'>";
							$content.= "<p>".$similarGame->descripGame."</p>";
							$content.= "<span class='final_parrafo'></span>";
							$content.= "<a class= 'juego_link' href='".$similarGame->idGame."'></a>";
						$content.= "</div>";
						$content.= "<div class='texto_descripcion'>";
							$content.= "<p>".$similargametagsview."</p>";
							$content.= "<span class='final_parrafo'></span>";
							$content.= "<a class= 'juego_link' href='".$similarGame->idGame."'></a>";
						$content.= "</div>";
					$content.= "</div>";
					
				$content.= "</div>";
				
			}
			$content.= "</div>";
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
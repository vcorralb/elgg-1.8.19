<?php
$title = elgg_echo('kpax:games');
elgg_register_title_button();

$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);

/* Get categories, platforms and skills */
$categories = $objKpax->getCategories($_SESSION["campusSession"]);
$platforms = $objKpax->getPlatforms($_SESSION["campusSession"]);
$skills = $objKpax->getSkills($_SESSION["campusSession"]);
$metadatas = $objKpax->getMetaDatas($_SESSION["campusSession"]);

/* Obtain category name, platform name and skill name for each id */
/*$cats = array();
$plats = array();
$skillss = array();
$metadatass = array();

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
foreach($metadatas as $metadata)
{
	$metadatass[$metadata->idMetadata] = $metadata->keyMeta;
}*/

/* Save last form value */
$name = " ";
$category = "0";
$platform = "0";
$ski = "0";
$tag = " ";
$keyMeta = "0";
$valueMeta = " ";
$sort = "1";
if(isset($_POST['name'])) $name = $_POST['name'];
if(isset($_POST['category'])) $category = $_POST['category'];
if(isset($_POST['platform'])) $platform = $_POST['platform'];
if(isset($_POST['skill'])) $ski = $_POST['skill'];
if(isset($_POST['tag'])) $tag = $_POST['tag'];
if(isset($_POST['keymeta'])) $keyMeta = $_POST['keymeta'];
if(isset($_POST['valuemeta'])) $valueMeta = $_POST['valuemeta'];
if(isset($_POST['sort'])) $sort = $_POST['sort'];

/* Search form*/

	$content.= "<br/><br/>";
	$content.="<div class='listado_juegos'>";
		$content.="<div class='menu_vertical'>";
			$content.="<h1>".elgg_echo('kpax:category')."</h1>";
				$selected="";
				if("0" == $category){
					$selected="font-weight: bold";
				}
				$content .= "<form method='post' action='all'>";
				$content .= "<fieldset>";
				$content .= "<input type='hidden' name='category' value='0' />";
				$content .= "<input style='".$selected."' type='submit' value='".elgg_echo('kpax:allcategories')."' />";
				$content .= "</fieldset>";
				$content .= "</form>";
				foreach($categories as $cat)
				{
					$selected="";
					if($cat->idCategory == $category){
						$selected="font-weight: bold";
					}
					$content .= "<form method='post' action='all'>";
					$content .= "<fieldset>";
					$content .= "<input type='hidden' name='category' value='".$cat->idCategory."' />";
					$content .= "<input style='".$selected."' type='submit' value='".$cat->name."' />";
					$content .= "</fieldset>";
					$content .= "</form>";
				}
		$content.="</div>";
			
		$content.="<div class='contenido'>";
			$content.="<div class='menu_horizontal'>";
			$content .= "<form method='post' action='all'>";
				$content.="<div class='menu_horizontal_busqueda'>";
					$content.="<div class='menu_horizontal_izquierda'>";
						$content .= "<input type='hidden' name='category' value='".$category."'/>";
						$content.="<p>";
							$content.="<label for='name'>".elgg_echo('kpax:name').": </label>";
							$content.="<input class='' type='text' name='name' id='name' value='".$name."'/>";
						$content.="</p>";
						$content.="<p>";
							$content.="<label for='tag'>".elgg_echo('kpax:tag').": </label>";
							$content.="<input class='' type='text' name='tag' id='tag' value='".$tag."'/>";
						$content.="</p>";

						$content.="<p>";
							$content.="<label for='keymeta'>".elgg_echo('kpax:metadata').": </label>";
							$content.="<select class='' name='keymeta' id='keymeta' >";
								$content .= "<option value='0'>".elgg_echo('kpax:allmetadata')."</option>";
								foreach($metadatas as $metadata)
								{
									$selected = "";
									if($metadata == $keyMeta)
										$selected = "selected='selected'";
									$content .= "<option value='".$metadata."' ".$selected.">".$metadata."</option>";
								}
							$content.="</select>";
							$content.="<input class='' type='text' name='valuemeta' id='valuemeta' value='".$valueMeta."'/>";
						$content.="</p>";
					$content.="</div>";
					
					$content.="<div class='menu_horizontal_derecha'>";
						$content.="<p>";
							$content.="<label for='platform'>".elgg_echo('kpax:platform').": </label>";
							$content.="<select class='' name='platform' id='platform' >";
								$content.="<option value='0'>".elgg_echo('kpax:allplatforms')."</option>";
								foreach($platforms as $plat)
								{
									$selected = "";
									if($plat->idPlatform == $platform)
										$selected = "selected='selected'";
									$content.="<option value='".$plat->idPlatform."' ".$selected.">".$plat->name."</option>";
								}
							$content.="</select>";
						$content.="</p>";

						$content.="<p>";
							$content.="<label for='skill'>".elgg_echo('kpax:skill').": </label>";
							$content.="<select class='' name='skill' id='skill' >";
								$content .= "<option value='0'>".elgg_echo('kpax:allskills')."</option>";
								foreach($skills as $skill)
								{
									$selected = "";
									if($skill->idSkill == $ski)
										$selected = "selected='selected'";
									$content .= "<option value='".$skill->idSkill."' ".$selected.">".$skill->name."</option>";
								}
							$content.="</select>";
						$content.="</p>";
					$content.="</div>";
				$content.="</div>";

/* Order form */
$selectedordenacio1 = "";
$selectedordenacio2 = "";
$selectedordenacio3 = "";
$selectedordenacio4 = "";
$selectedordenacio5 = "";
if("1" == $sort)
	$selectedordenacio1 = "selected='selected'";
else if("2" == $sort)
	$selectedordenacio2 = "selected='selected'";
else if("3" == $sort)
	$selectedordenacio3 = "selected='selected'";
else if("4" == $sort)
	$selectedordenacio4 = "selected='selected'";
else if("5" == $sort)
	$selectedordenacio5 = "selected='selected'";
	
				$content.="<div class='menu_horizontal_orden'>";
					$content.="<p>";
						$content.="<label for='sort'>".elgg_echo('kpax:sort').": </label>";
						$content.="<select class='' name='sort' id='sort' >";
							$content.="<option value='1' ".$selectedordenacio1.">".elgg_echo('kpax:name')."</option>";
							$content.="<option value='2' ".$selectedordenacio2.">".elgg_echo('kpax:category')."</option>";
							$content.="<option value='3' ".$selectedordenacio3.">".elgg_echo('kpax:platform')."</option>";
							$content.="<option value='4' ".$selectedordenacio4.">".elgg_echo('kpax:skill')."</option>";
						$content.="</select>";
					$content.="</p>";

				$content.="</div>";
			$content.="<div class='clearer'></div>";
			$content.="<div class='aligncenter'>";
				$content.="<input id='search_button' name='search_button' type='submit' value='".elgg_echo('kpax:search')."' />";
			$content.="</div>";
			$content.="</form>";
			
			$content.="</div>";


/* Call kPAX */
//if(strlen($name) != 0 || strlen($category) != 0 || strlen($platform) != 0 || strlen($ski) != 0 || strlen($tag) != 0 || strlen($keyMeta) != 0 || strlen($valueMeta) != 0) 
//{
	//The first time the application shows the results, it shows the first result ($offset = 0) and 9 results ($limit = 9).
	//$limit is every time 9, but offset depends on pagination
	$limit = 9;
	if (isset($_POST['offset'])){
		$offset = $_POST['offset'];
	}
	else {
		$offset = 0;
	}
	$gameList = $objKpax->getListGamesSearch($name, $category, $platform, $ski, $tag, $keyMeta, $valueMeta, $sort, $offset, $limit, $_SESSION["campusSession"]);
	
	
//Pagination
$content .= "<div class='pagination'><p>";
if ($gameList->offset > 0){
	//Previous
	$content .= "<div style='float: left;'>";
	$content .= "<form method='post' action='all'>";
	$content .= "<fieldset>";
	$content .= "<input type='hidden' name='name' value='".$name."'/>";
	$content .= "<input type='hidden' name='category' value='".$category."'/>";
	$content .= "<input type='hidden' name='platform' value='".$platform."'/>";
	$content .= "<input type='hidden' name='skill' value='".$ski."'/>";
	$content .= "<input type='hidden' name='tag' value='".$tag."'/>";
	$content .= "<input type='hidden' name='keymeta' value='".$keyMeta."'/>";
	$content .= "<input type='hidden' name='valuemeta' value='".$valueMeta."'/>";
	$content .= "<input type='hidden' name='sort' value='".$sort."'/>";
	$content .= "<input type='hidden' name='offset' value='".($offset-$limit)."'/>";
	$content .= "<input type='submit' value='".elgg_echo('kpax:previous')."' />";
	$content .= "</fieldset>";
	$content .= "</form>";
	$content .= "</div>";
}
if ($gameList->offset + $gameList->limit < $gameList->total->integer){
	//Next
	$content .= "<div style='float: right;'>";
	$content .= "<form method='post' action='all'>";
	$content .= "<fieldset>";
	$content .= "<input type='hidden' name='name' value='".$name."'/>";
	$content .= "<input type='hidden' name='category' value='".$category."'/>";
	$content .= "<input type='hidden' name='platform' value='".$platform."'/>";
	$content .= "<input type='hidden' name='skill' value='".$ski."'/>";
	$content .= "<input type='hidden' name='tag' value='".$tag."'/>";
	$content .= "<input type='hidden' name='keymeta' value='".$keyMeta."'/>";
	$content .= "<input type='hidden' name='valuemeta' value='".$valueMeta."'/>";
	$content .= "<input type='hidden' name='sort' value='".$sort."'/>";
	$content .= "<input type='hidden' name='offset' value='".($offset+$limit)."'/>";
	$content .= "<input type='submit' value='".elgg_echo('kpax:next')."' />";
	$content .= "</fieldset>";
	$content .= "</form>";
	$content .= "</div>";
	
}
$content.="<div class='clearer'></div>";
$content .= "</p></div>";

	
//}
//else $gameList = $objKpax->getListGames($_SESSION["campusSession"]);

//Obtain tags for each game
//Not necessary because this information is in $gameList
/*for ($i = 0, $sizeGameList = count($gameList); $i < $sizeGameList; $i++){
	$idGame = $gameList[$i]->idGame;
	$tags[$i] = $objKpax->getTagsGame($_SESSION["campusSession"],$idGame);
}*/

//DEFAULT OPTIONS FOR ELGG LISTING. All games.
/*$options = array(
	'type' => 'object',
	'subtype' => 'kpax',
	'container_guid' => $page_owner->guid,
	'limit' => 10,
	'offset' => $offset,
	'full_view' => false,
	'view_toggle_type' => false
);*/

if(isset($gameList->games))
{
	system_message(elgg_echo('kpax:list:success'));
	/*
	 * Adding the gameIds to the elgg list.
	 * 
	 * Forcing elgg to list the games in the same
	 * order as gotten from srvKpax. Not by default
	 * elgg order (time_created desc).
	 */
	/*$where = array();
	$orderBy = ' CASE ';
	for($i = 0, $size = sizeof($gameList); $i < $size; ++$i)
	{
		$idGame = $gameList[$i]->idGame;
		
		$where[] = $idGame;
		$orderBy = $orderBy . " WHEN e.guid = " . $idGame . " THEN " . ($i + 1);
	}
	$options = array_merge($options, array('guids' => $where));
	$orderBy = $orderBy . " END ";
	$options = array_merge($options, array('order_by' => $orderBy));*/
}
else
	register_error(elgg_echo('kpax:list:failed'));

/* Show results */
if(isset($gameList->games) && sizeof($gameList->games) > 0) { 	
	$content .= elgg_view('kpax/games_list', array('objGameList' => $gameList->games, 'categories' => $categories, 'platforms' => $platforms, 'skills' => $skills));
}
else {
    $content .= '<div><p>' . elgg_echo('kpax:none') . '</p></div>';
}

$content.="</div>"; //contenido
$content.="</div>"; //listado_juegos

$body = elgg_view_layout('one_column', array(
    'filter_context' => 'all',
    'content' => $content,
    'title' => $title
		));

/* CSS include */
$css_url = 'mod/kpax/views/default/css/elements/gamelist.css';
elgg_register_css('gamelist', $css_url);
elgg_load_css('gamelist');

echo elgg_view_page($title, $body);
?>



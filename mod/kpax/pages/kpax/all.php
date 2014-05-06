<?php
$title = elgg_echo('kpax:games');
elgg_register_title_button();

$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);

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

$name = "";
$category = "";
$platform = "";
$ski = "";
$sort = "";
if(isset($_POST['name'])) $name = $_POST['name'];
if(isset($_POST['category'])) $category = $_POST['category'];
if(isset($_POST['platform'])) $platform = $_POST['platform'];
if(isset($_POST['skill'])) $ski = $_POST['skill'];
if(isset($_POST['sort'])) $sort = $_POST['sort'];

// FORMULARI CERCA
$content .= "<br/><br/><form method=\"post\" action=\"all\">";
$content .= elgg_echo('kpax:search')."<hr/>";
$content .= "<table>";
$content .= "<tr height=\"45px\"><td width=\"200px\">".elgg_echo('kpax:name')."</td><td><input type=\"text\" name=\"name\" size =\"50\" value=\"".$name."\"/></td></tr>";
$content .= "<tr height=\"45px\"><td>".elgg_echo('kpax:category')."</td><td>";
$content .= "<select name=\"category\" id=\"category\" size=1>";
	$content .= "<option value=\"0\">".elgg_echo('kpax:allcategories')."</option>";
	foreach($categories as $cat)
	{
		$selected = "";
		if($cat->idCategory == $category)
			$selected = "selected";
		$content .= "<option value=\"".$cat->idCategory."\" ".$selected.">".$cat->name."</option>";
	}
$content .= "</select></td></tr>";
$content .= "<tr height=\"45px\"><td>".elgg_echo('kpax:platform')."</td><td>";
$content .= "<select name=\"platform\" id=\"platform\" size=1>";
	$content .= "<option value=\"0\">".elgg_echo('kpax:allplatforms')."</option>";
	foreach($platforms as $plat)
	{
		$selected = "";
		if($plat->idPlatform == $platform)
			$selected = "selected";
		$content .= "<option value=\"".$plat->idPlatform."\" ".$selected.">".$plat->name."</option>";
	}
$content .= "</select></td></tr>";
$content .= "<tr height=\"45px\"><td>".elgg_echo('kpax:skill')."</td><td>";
$content .= "<select name=\"skill\" id=\"skill\" size=1>";
	$content .= "<option value=\"0\">".elgg_echo('kpax:allskills')."</option>";
	foreach($skills as $skill)
	{
		$selected = "";
		if($skill->idSkill == $ski)
			$selected = "selected";
		$content .= "<option value=\"".$skill->idSkill."\" ".$selectedseleccio1.">".$skill->name."</option>";
	}
$content .= "</select></td></tr>";
$content .= "<tr height=\"45px\"><td>".elgg_echo('kpax:sort')."</td><td>";

$selectedordenacio1 = "";
$selectedordenacio2 = "";
$selectedordenacio3 = "";
$selectedordenacio4 = "";
$selectedordenacio5 = "";
if("1" == $sort)
	$selectedordenacio1 = "selected";
else if("2" == $sort)
	$selectedordenacio2 = "selected";
else if("3" == $sort)
	$selectedordenacio3 = "selected";
else if("4" == $sort)
	$selectedordenacio4 = "selected";
else if("5" == $sort)
	$selectedordenacio5 = "selected";

$content .= "<select name=\"sort\" id=\"sort\" size=1>							
					<option value=\"1\" ".$selectedordenacio1.">".elgg_echo('kpax:name')."</option>
					<option value=\"2\" ".$selectedordenacio2.">".elgg_echo('kpax:category')."</option>
					<option value=\"3\" ".$selectedordenacio3.">".elgg_echo('kpax:platform')."</option>
					<option value=\"4\" ".$selectedordenacio4.">".elgg_echo('kpax:skill')."</option>
			</select></td></tr>";
$content .= "<tr height=\"45px\"><td></td><td><input type=\"submit\" value=\"".elgg_echo('kpax:search')."\" /></td></tr>";
$content .= "</table></form><hr/><br/>";

if(strlen($name) != 0 || strlen($category) != 0 || strlen($platform) != 0 || strlen($ski) != 0) 
{
	$gameList = $objKpax->getListGamesSearch($name, $category, $platform, $ski, $sort, $_SESSION["campusSession"]);
}
else $gameList = $objKpax->getListGames($_SESSION["campusSession"]);

//DEFAULT OPTIONS FOR ELGG LISTING. All games.
$options = array(
	'type' => 'object',
	'subtype' => 'kpax',
	'container_guid' => $page_owner->guid,
	'limit' => 10,
	'offset' => $offset,
	'full_view' => false,
	'view_toggle_type' => false
);

if(isset($gameList))
{
	system_message(elgg_echo('kpax:list:success'));
	/*
	 * Adding the gameIds to the elgg list.
	 * 
	 * Forcing elgg to list the games in the same
	 * order as gotten from srvKpax. Not by default
	 * elgg order (time_created desc).
	 */
	$where = array();
	$orderBy = ' CASE ';
	for($i = 0, $size = sizeof($gameList); $i < $size; ++$i)
	{
		$idGame = $gameList[$i]->idGame;
		
		$where[] = $idGame;
		$orderBy = $orderBy . " WHEN e.guid = " . $idGame . " THEN " . ($i + 1);
	}
	$options = array_merge($options, array('guids' => $where));
	$orderBy = $orderBy . " END ";
	$options = array_merge($options, array('order_by' => $orderBy));
}
else
	register_error(elgg_echo('kpax:list:failed'));

//ho fem nom�s si torna algun resultat sino no en posem cap
if(isset($gameList) && sizeof($gameList) > 0) { 	
	$content .= elgg_view('kpax/games_list', array('objGameList' => $gameList, 'categories' => $categories, 'platforms' => $platforms, 'skills' => $skills));
}
if (!$content) {
    $content = '<p>' . elgg_echo('kpax:none') . '</p>';
}

$body = elgg_view_layout('content', array(
    'filter_context' => 'all',
    'content' => $content,
    'title' => $title,
    'sidebar' => elgg_view('kpax/sidebar'),
        ));
			

echo elgg_view_page($title, $body);
?>



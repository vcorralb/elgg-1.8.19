	<?php
echo "<h2>".elgg_echo('kpax:listgames')."</h2>";
if($vars['categories'] && $vars['platforms'] && $vars['skills'])
{
	$cats = array();
	$plats = array();
	$skillss = array();

	foreach($vars['categories'] as $cat)
	{
		$cats[$cat->idCategory] = $cat->name;
	}
	foreach($vars['platforms'] as $plat)
	{
		$plats[$plat->idPlatform] = $plat->name;
	}
	foreach($vars['skills'] as $skill)
	{
		$skillss[$skill->idSkill] = $skill->name;
	}

	if ($vars['objGameList']) {
		?>
		<br/>
		<div class='score' style='border:1px solid #cccccc; padding:5px; padding-left: 12px; text-align:left;width: 98%;'>
			<p><b><?php echo elgg_echo('kpax:game'); ?></b></p>
			<table class="listgames">
			<?php
			echo "<tr height=\"40px\"><td width=\"300px\"><b>". elgg_echo('kpax:name') ."</b></td><td width=\"160px\"><b>". 
					elgg_echo('kpax:category')."</b></td><td width=\"160px\"><b>". elgg_echo('kpax:platform')."</b></td><td width=\"160px\"><b>". 
					elgg_echo('kpax:skill')."</b></td><td width=\"160px\"><b>". elgg_echo('kpax:tags')."</b></td>
					<td width=\"160px\"><b>". elgg_echo('kpax:descripGame')."</b></td></tr>";

			foreach ($vars['objGameList'] as $game) {
				$catview = "";
				$platview = "";
				$skillview = "";
				if($game->idCategory != 0)
					$catview = $cats[$game->idCategory];
				if($game->idPlatform != 0)
					$platview = $plats[$game->idPlatform];
				if($game->idSkill != 0)
					$skillview = $skillss[$game->idSkill];
				$tagsview ="";
				foreach($game->tags as $tag){
					$tagsview .= $tag->tag." ";
				}
				echo "<tr><td width=\"300px\"><a href=view/" . $game->idGame . ">". $game->name ."</a></td><td width=\"160px\">". 
					$catview."</td><td width=\"160px\">". $platview."</td><td width=\"160px\">". $skillview."</td>".
					"<td width=\"160px\">". $tagsview."</td><td width=\"160px\">". $game->descripGame."</td></tr>";
			}
			?>
			</table>
		</div>
		<?php
	}
	else
	{ 
		elgg_echo('kPAX:noGames');
	}
}
?> 
	<?php
echo "<h2>".elgg_echo('kpax:listgames')."</h2>";
if($vars['categories'] /*&& $vars['platforms'] && $vars['skills']*/)
{
	$cats = array();
	/*$plats = array();
	$skillss = array();*/

	foreach($vars['categories'] as $cat)
	{
		$cats[$cat->idCategory] = $cat->name;
	}
	/*foreach($vars['platforms'] as $plat)
	{
		$plats[$plat->idPlatform] = $plat->name;
	}
	foreach($vars['skills'] as $skill)
	{
		$skillss[$skill->idSkill] = $skill->name;
	}*/

	if ($vars['objGameList']) {	
		
		echo "<div class='contenedor_juegos'>";
		
			foreach ($vars['objGameList'] as $game) {
				$catview = "";
				/*$platview = "";
				$skillview = "";*/
				if($game->idCategory != 0)
					$catview = $cats[$game->idCategory];
				/*if($game->idPlatform != 0)
					$platview = $plats[$game->idPlatform];
				if($game->idSkill != 0)
					$skillview = $skillss[$game->idSkill];*/
				$tagsview ="";
				foreach($game->tags as $tag){
					if ($tag != null){
						$tagsview .= $tag->tag." ";
					}
				}
				echo "<div class='cuadro_juego'>";
					
					echo "<a class= 'juego_link' href='"."view/" . $game->idGame."'></a>";
					echo "<div class='juego_foto'>";
						echo "<a class= 'juego_link' href='"."view/" . $game->idGame."'>";
							echo "<img src='".$game->urlImage."' alt='".$game->name."' width='140' height='160' />";
							echo "<span class='transicion' />";	
						echo "</a>";
					echo "</div>";
					echo "<div class='juego_texto'>";
						echo "<a class= 'juego_link' href='"."view/" . $game->idGame."'></a>";
						echo "<h2><a href='"."view/" . $game->idGame."'>".$game->name."<span class='final_parrafo final_parrafo_titulo'></span></a>";
							
						echo "</h2>";
						echo "<div class='texto_descripcion'>";
							echo "<p>".$game->descripGame."</p>";
							echo "<span class='final_parrafo'></span>";
							echo "<a class= 'juego_link' href='"."view/" . $game->idGame."'></a>";
						echo "</div>";
						echo "<div class='texto_descripcion'>";
							echo "<p>".$catview."</p>";
							echo "<span class='final_parrafo'></span>";
							echo "<a class= 'juego_link' href='"."view/" . $game->idGame."'></a>";
						echo "</div>";
						echo "<div class='texto_descripcion'>";
							echo "<p>".$tagsview."</p>";
							echo "<span class='final_parrafo'></span>";
							echo "<a class= 'juego_link' href='"."view/" . $game->idGame."'></a>";
						echo "</div>";
					echo "</div>";
				echo "</div>";		
			}
		echo "</div>";
	}
	else
	{ 
		elgg_echo('kpax:nogames');
	}

}
?> 
<div>
<form id="freitext" class="form" action="./#quiz" method="post">
<?php
//Lade Frage inklusive Hinweis
$stmt = $dbh->prepare("SELECT * FROM freitext WHERE id = :quiz_id");
$stmt->bindParam(":quiz_id", $result["id"]);
$stmt->execute();
$freitext = $stmt->fetch();
?>
	<div class="info-block">
		<div class="info-text">
			<h3>Freitext - Nr. <?php echo $freitext["id"]?></h3>
			<p>
				<?php echo $freitext["frage"]?>
			</p>
			<?php
			//Gebe Hinweis aus
			if ($versuch == 1){
				?>
				<br>
				<p>
					Hinweis: <?php echo $freitext["hinweis"]?>
				</p>
				<?php
			}
			?>
			<br>
			<p>
				<input type="hidden" name="typ" value="3">
			</p>
			<p>
				<input type="hidden" name="number" value="<?php echo $freitext["id"]?>">
			</p>
			<p>
				<input type="text" placeholder="Antwort" name="answer">
			</p>
			<input type="submit" style="position: absolute; left: -9999px"/>
			<p>
				<a class="submit" href="javascript:void(0)" onclick="$('#freitext').submit()">Absenden</a>
			</p>
		</div>
	</div>
</form>
</div>
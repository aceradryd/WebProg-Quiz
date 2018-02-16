<div>
<form id="singleChoice" class="form" action="./#quiz" method="post">
<?php
//Lade Fragestellung inklusive Hilfestellung
$stmt = $dbh->prepare("SELECT * FROM singleChoice WHERE id = :id");
$stmt->bindParam(":id", $result["id"]);
$stmt->execute();
$singleChoice = $stmt->fetch();
?>
	<div class="info-block">
		<div class="info-text">
			<h3>Single Choice - Nr. <?php echo $singleChoice["id"]?></h3>
			<p>
				<?php echo $singleChoice["frage"]?>
			</p>
			<?php
			//Gebe Hinweis, falls zweiter Versuch
			if ($versuch == 1){
				?>
				<br>
				<p>
					Hinweis: <?php echo $singleChoice["hinweis"]?>
				</p>
				<?php
			}
			?>
			<br>
			<p>
				<input type="hidden" name="typ" value="1">
			</p>
			<p>
				<input type="hidden" name="number" value="<?php echo $singleChoice["id"]?>">
			</p>
			<?php
			//Lade zur SingleChoice-Aufgabe gehörende Antworten und markiere die erste als "Checked"
			$stmt = $dbh->prepare("SELECT * FROM singleChoiceAnswers WHERE singleChoice_id = :id ORDER BY RAND()");
			$stmt->bindParam(":id", $singleChoice["id"]);
			$stmt->execute();
			$singleChoiceAnswers = $stmt->fetchAll();
			$first = true;
			foreach($singleChoiceAnswers as $answers){
			?>
			<p>
				<input type="radio" name="answer" value="<?php echo $answers["id"]?>" style="width: auto" <?php if($first){$first = false; echo "checked";}?>><?php echo $answers["antwort"]?>
			</p>
			<?php
			}
			?>
			<input type="submit" style="position: absolute; left: -9999px"/>
			<p>
				<a class="submit" href="javascript:void(0)" onclick="$('#singleChoice').submit()">Absenden</a>
			</p>
		</div>
	</div>
</form>
</div>
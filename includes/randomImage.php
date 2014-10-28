<?php

$query = "
	SELECT
		img
	FROM randomImages
	";

try
{
	$stmt = $pdo->prepare($query);
	$result = $stmt->execute();
}
catch(PDOException $ex)
{
	die("Failed to run query: " . $ex->getMessage());
}

$rowImg = $stmt->fetchAll();

// Mynd er valin eftir því hvaða mínóta það er.
function minuteImg($images){
	$minute = date('i'); // Ná í núverandi mínótu
	$number = 60 / count($images); // Deila í 60 með fjöldi mynda
	$array = []; // Initialize array

	// Búa til comparison array
	for($i = 1; $i <= count($images); $i++){
		array_push($array, $number * $i);
	}

	$last = null; // Síðasta value
	$selected = null; // Index myndarinnar sem verður valin

	// Velja mynd með því að finna hvaða value í $array er næst $minute
	for($i = 0; $i < count($array); $i++){
		if($array[$i] < $minute){
			$last = $array[$i];
		}
		elseif ($array[$i] == $minute){
			$selected = $i;
			break;
		}
		elseif ($array[$i] > $minute){
			$selected = $i;
			break;
		}
	}

	sort($images); // Sorta

	// Myndin
	echo $randomImage = $images[$selected]['img'];
}

function randomImg($images){
	$max = count($images) - 1;
	echo $images[rand(0, $max)]['img'];
}
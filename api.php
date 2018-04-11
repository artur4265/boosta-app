<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
header('Content-Type: text/json; charset=utf-8');

switch ($_REQUEST["lang"]) {
	case 'ru-RU':
	$resPositive = 'Треугольник может сущевствовать';
	$resNegative = 'Треугольник не может сущевствовать!';
	$typeSimilar = 'Равнобедренный';
	$typeAnother = 'Разностронний';
	$error = 'Переменные не дошли. Проверьте все еще раз.';
	break;

	default:
	$resPositive = 'Triangel can be';
	$resNegative = 'Triangel can\'t be!';
	$typeSimilar = 'Similar';
	$typeAnother = 'Another';
	$error = 'Vars not enter';
	break;
}

$answer = new stdClass();

if (!empty($_REQUEST["a"])&&!empty($_REQUEST["b"])&&!empty($_REQUEST["c"])) { 
	$a = trim($_REQUEST["a"]);
	$b = trim($_REQUEST["b"]);
	$c = trim($_REQUEST["c"]);
	if (!is_numeric($a) || !is_numeric($b) || !is_numeric($c)) {
		$answer->error = $error;
		echo json_encode($answer, JSON_UNESCAPED_UNICODE);
	} else {
		if ( ($a - $b) < $c && $c < ($a + $b) && ($a - $c) < $b && $b < ($a + $c) && ($b - $c) < $a && $a < ($b + $c) ) {
			if ($a == $b || $a == $c || $b == $c) {
				$answer->type = $typeSimilar;
			} else {
				$answer->type = $typeAnother;
			}
			$answer->res = $resPositive;
			echo json_encode($answer, JSON_UNESCAPED_UNICODE);
		} else {
			$answer->res = $resNegative;
			echo json_encode($answer, JSON_UNESCAPED_UNICODE);
		}  	
	}
} else { 
	$answer->error = $error;
    echo json_encode($answer, JSON_UNESCAPED_UNICODE);
}

?>
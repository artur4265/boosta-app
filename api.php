<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
header('Content-Type: text/json; charset=utf-8');
define('JSON_UNESCAPED_UNICODE', 256);

// Проверяем язык
switch ($_REQUEST["lang"]) {
	case 'ru-RU':
	$resPositive = 'Треугольник может существовать!';
	$resNegative = 'Треугольник не может существовать!';
	$typeSimilar = 'Тип треугольника - Равнобедренный';
	$typeAnother = 'Тип треугольника - Разносторонний';
	$error = 'Переменные не дошли. Проверьте все еще раз.';
	$notNum = 'Введите число(а)!';
	break;

	default:
	$resPositive = 'A triangle can be!';
	$resNegative = 'А triangle can not be!';
	$typeSimilar = 'Type of triangle - Isosceles';
	$typeAnother = 'Type of triangle - Versatile';
	$error = 'The variables did not send. Check everything again.';
	$notNum = 'Enter number(s)!';
	break;
}

$answer = new stdClass();
// Проверяем наличие данных
if (!empty($_REQUEST["a"])&&!empty($_REQUEST["b"])&&!empty($_REQUEST["c"])) { 

	$a = str_replace(',', '.', trim($_REQUEST["a"]));
	$b = str_replace(',', '.', trim($_REQUEST["b"]));
	$c = str_replace(',', '.', trim($_REQUEST["c"]));
	// Проверить ввели ли числа
	if (!is_numeric($a) || !is_numeric($b) || !is_numeric($c)) {
		$answer->error = $notNum;
		echo json_encode($answer, 256);
	} else {
		// Проверить существует ли треугольник
		if ( ($a - $b) < $c && $c < ($a + $b) && ($a - $c) < $b && $b < ($a + $c) && ($b - $c) < $a && $a < ($b + $c) ) {
			// Тип треугольника
			if ($a == $b || $a == $c || $b == $c) {
				$answer->type = $typeSimilar;
			} else {
				$answer->type = $typeAnother;
			}
			$answer->res = $resPositive;
			echo json_encode($answer, 256);
		} else {
			// Треугольник не может существовать
			$answer->res = $resNegative;
			echo json_encode($answer, 256);
		}
	}
} else { 
	// Ошибка
	$answer->error = $error;
    echo json_encode($answer, 256);
}

?>
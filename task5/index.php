<?php require_once('php/func.php'); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Task 4</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="container">
		<form method="post">
			<label class="lables" for="country_name">Добавить страну</label><br>
			<input type="text" name="country_name" id="country_name"><br>
			<input type="submit" name="add" value="Добавить страну" class="button">
		</form>
		<button id="show-element" class="button">Показать страны</button>
		<div id="to-show" class="hide">
			<table>
				<tr>
					<th>Порядковый<br> номер</th>
					<th>Страна</th>
				</tr>
				<?php countryList($connection); ?>
			</table>
		</div>
	</div>
	<?php mysqli_close($connection); ?>
	<script src="js/auto_hide.js"></script>
</body>

</html>
<?php

require_once __DIR__ . '/app/init.php';

$itemsQuery = $db->prepare("
 SELECT id, name, done
 FROM items
 WHERE user = :user
 ");

$itemsQuery->execute([
 'user' => $_SESSION['user_id']
 ]);

//$items = $itemsQuery->rowCount() ? $itemsQuery : [] ;

$items = $itemsQuery->fetchALL();
foreach($items as $item)


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>To Do List</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<div class="list">
			<h1 class="header">To Do</h1>

      <?php if(!empty($items)): ?>
			<ul class="items">
        <?php foreach($items as $item): ?>
				  <li>
				    <span class="item<?php echo $item['done']? ' done' : '' ?>"><?php echo $item['name']; ?></span>
            <?php if(!$item['done']): ?>
				    <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Markeer als klaar</a>
          <?php endif; ?>
				</li>
      <?php endforeach; ?>
			</ul>
    <?php else:?>
        <p>je hebt nog geen items toegevoegd</p>
    <?php endif;?>

			<form class="item-add" action="add.php" method="post">
				<input type="text" name="name" placeholder="voeg een nieuw item toe" class="input" autocomplete="off" required>
				<input type="submit" value="Voeg Toe" class="submit">
			</form>

		</div>
	</body>
</html>
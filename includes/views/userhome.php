<?php
$user = unserialize($_SESSION['user']);
render( '_header', array( 'title' => $title ) );
?>

<div id="lists">
<?php foreach ($user->lists as $list) { ?>
	<a href="./?list=<?php echo $list->lID ?>" <?php echo tabTitleTip($list->title) ?>><?php echo tabTitle($list->title) ?></a>
<?php } ?>
</div>

<?php if ( isset($lID) ) { ?>

<h2><?php echo $listTitle ?></h2>
<script type="text/javascript" > var elements = <?php echo count($elements) ?>; </script>
<div id="elements">
	<div id="addElement">
		<form action="index.php?list=<?php echo $lID ?>&action=add" method="POST"><div>
			<label for="title"><img src="assets/images/pencil.png" alt="pencil" /></label><input type="text" name="title" id="title" />
			<label for="link"><img src="assets/images/link.png" alt="link" /></label><input type="text" name="link" id="link" />
			<input type="submit" value="Add" />
		</div></form>
	</div>

<?php foreach ($elements as $element) { ?>
	<div class="element" id="element<?php echo $element->eID ?>">
<?php
	echo '<span class="';
	if ( $element->important ) echo 'important ';
	if ( !$element->active ) echo 'done ';
	echo '">' . $element->title . '</span>';
	if ( $element->link != '#' ) echo '<a href="'.$element->link.'"><img src="assets/images/link.png" alt="link"/></a>';
?>
		<div>
			<img src="assets/images/important.png" class="importantButton" data-eID="<?php echo $element->eID ?>" />
			<img src="assets/images/done.png" class="doneButton" data-eID="<?php echo $element->eID ?>" />
			<img src="assets/images/delete.png" class="deleteButton" data-eID="<?php echo $element->eID ?>" />
			<img src="assets/images/edit.png" class="editButton" data-eID="<?php echo $element->eID ?>" />
		</div>
	</div>
<?php } ?>
</div>

<?php } ?>

<?php render('_footer')?>

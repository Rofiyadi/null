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
<script type="text/javascript" > var entries = <?php echo count($entries) ?>; </script>
<div id="entries">
	<div id="addEntry">
		<form action="index.php?entry=<?php echo $lID ?>&action=add" method="POST"><div>
			<label for="title"><img src="assets/images/pencil.png" alt="pencil" /></label><input type="text" name="title" id="title" />
			<label for="link"><img src="assets/images/link.png" alt="link" /></label><input type="text" name="link" id="link" />
			<input type="hidden" name="lID" value="<?php echo $lID ?>" />
			<input type="submit" value="Add" />
		</div></form>
	</div>

<?php foreach ($entries as $entry) { ?>
	<div class="entry" id="entry<?php echo $entry->eID ?>">
<?php
	echo '<span class="';
	if ( $entry->important ) echo 'important ';
	if ( !$entry->active ) echo 'done ';
	echo '">' . $entry->title . '</span>';
	if ( $entry->link != '#' ) echo '<a href="'.$entry->link.'"><img src="assets/images/link.png" alt="link"/></a>';
?>
		<div>
			<img src="assets/images/important.png" class="importantButton" data-eID="<?php echo $entry->eID ?>" />
			<img src="assets/images/done.png" class="doneButton" data-eID="<?php echo $entry->eID ?>" />
			<img src="assets/images/delete.png" class="deleteButton" data-eID="<?php echo $entry->eID ?>" />
			<img src="assets/images/edit.png" class="editButton" data-eID="<?php echo $entry->eID ?>" />
		</div>
	</div>
<?php } ?>
</div>

	<div class="popUpShader" id="confirmBox">
		<div class="popUpWindow">
			<h3 class="popUpWindowTitleBar">Confirm Deletion</h3>
			<div class="popUpContent"><div>Delete entry? <span></span></div>
			<button id="cancel">Cancel</button> <button id="delete">Delete</button></div>
		</div>
	</div>

<?php } ?>

<?php render('_footer')?>

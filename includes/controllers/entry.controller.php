<?php

/* This controller handles entries */

class EntryController
{
	public function handleRequest()
	{
		// Redirect to login screen
		if ( !isset($_SESSION['loggedIn']) )
		{
			$c = new HomeController();
			$c->handleRequest();
			return;
		}

		$user = unserialize($_SESSION['user']);
		$eID = $_GET['entry'];
		if ( !is_numeric($eID) )
			throw new Exception('Malformated values!');
		$action = isset($_GET['action']) ? $_GET['action'] : '';

		if ( $action == 'add' )
		{
			$_POST['uID'] = $user->uID;
			Entry::insert( $_POST );

			header('Location: ?list=' . $_POST['lID']);
		}
		else if ( $action == 'drop' )
		{
			Entry::delete( array( 'uID' => $user->uID, 'eID' => $eID ) );
			render('_empty', array( 'eID' => $eID, 'msg' => 'OK' ));
		}
		else if ( $action == 'important' )
		{
			Entry::toggleImportant( array( 'uID' => $user->uID, 'eID' => $eID ) );
			render('_empty', array( 'eID' => $eID, 'msg' => 'OK' ));
		}
		else if ( $action == 'done' )
		{
			Entry::toggleDone( array( 'uID' => $user->uID, 'eID' => $eID ) );
			render('_empty', array( 'eID' => $eID, 'msg' => 'OK' ));
		}
		else
			throw new Exception('Wrong action specified!');
	}
}

?>

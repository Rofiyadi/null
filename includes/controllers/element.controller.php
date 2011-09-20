<?php

/* This controller handles elements */

class ElementController
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
		$eID = $_GET['element'];
		if ( !is_numeric($eID) )
			throw new Exception('Malformated values!');
		$action = isset($_GET['action']) ? $action = $_GET['action'] : '';

		if ( $action == 'drop' )
		{
			Element::delete( array( 'uID' => $user->uID, 'eID' => $eID ) );
			render('_empty', array( 'eID' => $eID, 'msg' => 'OK' ));
		}
		else if ( $action == 'important' )
		{
			Element::toggleImportant( array( 'uID' => $user->uID, 'eID' => $eID ) );
			render('_empty', array( 'eID' => $eID, 'msg' => 'OK' ));
		}
		else if ( $action == 'done' )
		{
			Element::toggleDone( array( 'uID' => $user->uID, 'eID' => $eID ) );
			render('_empty', array( 'eID' => $eID, 'msg' => 'OK' ));
		}
		else
			throw new Exception('Wrong action specified!');
	}
}

?>

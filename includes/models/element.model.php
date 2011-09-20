<?php

class Element
{

	public static function find ($arr = array())
	{
		global $db;

		$st = $db->prepare("SELECT * FROM elements WHERE lID=:lID ORDER BY eID");
		$st->execute( array(':lID' => $arr['lID']) );

		$st->execute($arr);

		return $st->fetchAll(PDO::FETCH_CLASS, "Element");
	}

	public static function delete ($arr = array())
	{
		global $db;

		$st = $db->prepare("SELECT eID FROM elements, lists WHERE elements.lID = lists.lID AND lists.uID=:uID AND eID=:eID");
		$st->execute( array(':uID' => $arr['uID'], ':eID' => $arr['eID']) );

		$res = $st->fetchAll(PDO::FETCH_BOTH);

		if ( empty($res) )
			throw new Exception("Non-authorized action!");

		$st = $db->prepare("DELETE FROM elements WHERE eID=:eID");
		$st->execute( array(':eID' => $arr['eID']) );
	}

	public static function toggleImportant ($arr = array())
	{
		global $db;

		$st = $db->prepare("SELECT eID FROM elements, lists WHERE elements.lID = lists.lID AND lists.uID=:uID AND eID=:eID");
		$st->execute( array(':uID' => $arr['uID'], ':eID' => $arr['eID']) );

		$res = $st->fetchAll(PDO::FETCH_BOTH);

		if ( empty($res) )
			throw new Exception("Non-authorized action!");

		$st = $db->prepare("UPDATE elements SET important = important XOR true WHERE eID=:eID");
		$st->execute( array(':eID' => $arr['eID']) );
	}

	public static function toggleDone ($arr = array())
	{
		global $db;

		$st = $db->prepare("SELECT eID FROM elements, lists WHERE elements.lID = lists.lID AND lists.uID=:uID AND eID=:eID");
		$st->execute( array(':uID' => $arr['uID'], ':eID' => $arr['eID']) );

		$res = $st->fetchAll(PDO::FETCH_BOTH);

		if ( empty($res) )
			throw new Exception("Non-authorized action!");

		$st = $db->prepare("UPDATE elements SET active = active XOR true WHERE eID=:eID");
		$st->execute( array(':eID' => $arr['eID']) );
	}
}

?>

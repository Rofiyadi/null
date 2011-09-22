<?php

class TodoList
{

	public static function find ($arr = array())
	{
		global $db;

		if ( !isset($arr['lID']) )
		{
			$st = $db->prepare("SELECT * FROM lists WHERE uID=:uID AND parentList = -1 ORDER BY lID");
			$st->execute( array(':uID' => $arr['uID']) );
		}
		else if ( isset($arr['lID']) && is_numeric($arr['lID']) )
		{
			$st = $db->prepare("SELECT * FROM lists WHERE uID=:uID AND lID=:lID");
			$st->execute( array(':uID' => $arr['uID'], ':lID' => $arr['lID']) );
		}
		else
		{
			throw new Exception("Malformated values!");
		}

		return $st->fetchAll(PDO::FETCH_CLASS, "TodoList");
	}

}

?>

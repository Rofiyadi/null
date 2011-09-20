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

	public static function insert ($arr = array())
	{
		global $db;

		if ( isset($arr['title']) && !empty($arr['title']) )
		{
			$st = $db->prepare("INSERT INTO elements (lID, title) VALUES(:lID, :title)");
			$st->execute( array(':lID' => $arr['lID'], ':title' => $arr['title']) );
		}
		else
		{
			throw new Exception("Malformated values!");
		}
	}
}

?>

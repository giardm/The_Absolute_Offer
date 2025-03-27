<?php
class DataModel
{
  public function getData()
  {
    $db = Database::getInstance();
    $query = "SELECT game_id FROM featured_offers";
    $result = $db->query($query);
    return $result;
  }
}

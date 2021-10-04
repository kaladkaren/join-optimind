<?php

/**
* returns the api url
* @param  object $class    the `$this` object
* @return string           example: http://localhost/restigniter-crud/api/crud/27
*
* @author: @jjjjcccjjf
*/
function api_url($class)
{
  return base_url() . "api/" . strtolower(get_class($class)) . "/";
}

function getPositions($that)
{
  $that->db->order_by('position_name', 'asc');
  return $that->db->get('positions')->result();
}

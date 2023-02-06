<?php
// Find a value in a multidimensional array
function findValue($array, $key, $value) {
  foreach($array as $item) {
    if(is_array($item) && findValue($item, $key, $value)) {
      return true;
    }

    if(isset($item[$key]) && $item[$key] == $value) {
      return true;
    }
  }

  return false;
}

// Sanitize input and output
function escape($io) {
  return htmlentities($io, ENT_QUOTES, 'UTF-8');
}
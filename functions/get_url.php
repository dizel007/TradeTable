<?php
function remove_key($key) {
  parse_str($_SERVER['QUERY_STRING'], $vars);
  $url = strtok($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?') . http_build_query(array_diff_key($vars,array($key=>"")));
  return $url;
}

function removeDomain($url) {
  $withoutProtocolDelimiter = str_replace('//', '', $url);
  $withoutProtocolDelimiter = str_replace('index.php', '', $url);
  
  // echo "ppp=".$withoutProtocolDelimiter."<br>";
  $jjj = substr($withoutProtocolDelimiter, strpos($withoutProtocolDelimiter, '/') + 1);
  // echo "jjj=".$jjj."<br>";
  $jjj = "?".substr($jjj, strpos($jjj, '/') + 1);
  // echo "ooo=".$jjj."<br>";
  return $jjj;
}
?>
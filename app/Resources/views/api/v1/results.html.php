<?php
  if($format == 'csv')
  {
    header("Content-Type: text/csv");
    // header("Content-Disposition: attachment; filename=data.csv");
  }

  echo $results;
 ?>

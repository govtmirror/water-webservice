<?php
  if($format == 'csv')
  {
    header("Content-Type: text/csv");
  }
  if($download == 'true')
  {
    header("Content-Disposition: attachment; filename=data.csv");
  }

  echo $results;
 ?>

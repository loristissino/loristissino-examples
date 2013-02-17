<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Standard deviation</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>
<?php

/*
 * Calculates the average of an array
 * 
 * @param array $data the array of data
 * @returns float the average
*/
function average($data=array())
{
  return array_sum($data) / count($data);
}


/*
 * Calculates the sum of the squares of the difference from the average
 * 
 * @param array $data the array of data
 * @returns float the sum of the squares
*/
function avgdiffsquares($data=array())
{
  $avg = average($data);
  $sq=0;
  foreach($data as $datum)
  {
    $sq += pow($datum - $avg, 2);
  }
  return $sq;
}


/*
 * Calculates the standard deviation based on a sample
 * 
 * @param array $data the array of data
 * @returns float the standard deviation
*/
function stdev($data=array())
{
  return sqrt(avgdiffsquares($data)/(count($data)-1));
}

/*
 * Calculates the standard deviation based on the entire population
 * 
 * @param array $data the array of data
 * @returns float the standard deviation
*/
function stdevp($data=array())
{
  return sqrt(avgdiffsquares($data)/count($data));
}

/*
 * Extracts a random sample of data from an array
 * 
 * @param array $data the array of data to extract from
 * @param int $count the number of items to extract
 * @returns array the sample
*/
function sample($data=array(), $count)
{
  if($count>count($data))
  {
    return $data;
  }
  
  $r=array();
  for($i=0; $i<$count; $i++)
  {
    $index=rand(0,count($data)-1);
    $r[]=$data[$index];
  }
  return $r;
}

/*
 * Returns the percentage of value1 on value2
 * 
 * @param float $value1
 * @param float $value2
 * @param int $decimals
 * @returns string the percentage
*/
function perc($value1, $value2, $decimals=2)
{
  return round(100 * $value1 / $value2) . "%";
}



$data=array(
10,
11,
15,
20,
21,
23,
24,
25,
25,
26,
27,
30,
32,
33,
40,
41,
43,
50,
52,
53,
54,
56,
57,
59,
60,
70,
80,
);

?>
<h1>Standard deviation example</h1>
<h2>Data</h2>
<p><?php echo implode(', ', $data) ?></p>
<h2>Stdev</h2>
<p><?php echo $stdev = stdev($data) ?></p>
<h2>Stdevp</h2>
<p><?php echo $stdevp = stdevp($data) ?></p>

<h2>Samples</h2>
<?php $s_stdev=array(); $s_stdevp=array() ?>
<?php for($i=1; $i<=100; $i++): ?>
  <h3>Sample <?php echo $i ?></h3>
  <?php $sample=sample($data, 10) ?>
  <p><?php echo implode(', ', $sample) ?></p>
  <p>Stdev: <?php echo $s_stdev[$i] = stdev($sample) ?></p>
  <p>Stdevp: <?php echo $s_stdevp[$i] = stdevp($sample) ?></p>
<?php endfor ?>

<h2>Comparisons</h2>
<p>Stdevp: <?php echo $stdevp ?> (what we want to estimate)</p>
<p>Average(stdevp(samples)): <?php echo $a = average($s_stdevp) ?> (<?php echo perc($a, $stdevp) ?>)</p>
<p>Average(stdev(samples)): <?php echo $b = average($s_stdev) ?> (<?php echo perc($b, $stdevp) ?>)</p>

</body>
</html>

<hmtl>
<head>
<title>CODE WARS</title>
</head>
<body>
<?php

#4 kyu Conway's Game of Life - Unlimited Edition
/*Given a 2D array and a number of generations, compute n timesteps of Conway's Game of Life.

The rules of the game are:

Any live cell with fewer than two live neighbours dies, as if caused by underpopulation.
Any live cell with more than three live neighbours dies, as if by overcrowding.
Any live cell with two or three live neighbours lives on to the next generation.
Any dead cell with exactly three live neighbours becomes a live cell.
Each cell's neighborhood is the 8 cells immediately around it (i.e. Moore Neighborhood).
 The universe is infinite in both the x and y dimensions and all cells are initially dead - except for those
 specified in the arguments. The return value should be a 2d array cropped around all of the living cells.
 (If there are no living cells, then return [[]].)

For illustration purposes, 0 and 1 will be represented as ░░ and ▓▓ blocks
 respectively (PHP, C: plain black and white squares). You can take advantage
  of the htmlize function to get a text representation of the universe, e.g.:*/
set_time_limit(10);
function removeRow($array)
{
  $newArray=$array;
  $sum=0;
  $repeat=false;
  do
  {
  $array=$newArray;
  $repeat=false;
  for($k=0;$k<count($array);$k++)
  {
    echo "array [$k][$n]<br>";
    for($n=0;$n<count($array[$k]);$n++)
    {
      $sum+=$array[$k][$n];

    }
    if($sum==0)
    {
      $repeat=true;
      for($row=0;$row<count($array)-1;$row++)
      {
        for($column=0;$column<count($array[$column]);$column++)
        {
          if($k>$row)
          {
            $newArray=$array[$row][$column];
          }
          else
          {
            $newArray=$array[$row+1][$column];
          }
        }
      }
    }
    echo "wtf";
    print_r($newArray);
    $sum=0;
    }
  }while($repeat==true and !empty($array));
echo "przeszlo";
return $array;
}







function lifeStage(array $array,int $k,int $n)
{
  $aliveNeigbor=0;
  for($column=-1;$column<=1;$column++)
  {
    for($row=-1;$row<=1;$row++)
    {
      if($array[$k-$column][$n-$row]==1)
      {
        if($column==0 && $row==0)
        {
          continue;
        }
        $aliveNeighbor++;
      }
    }
  }

  return $aliveNeighbor;
}


$generation=2;
$arrayAliveNeighbors=array();
$newGeneration=array();
$width=3;
$height=3;
for($k=0;$k<$height;$k++)
{
  for($n=0;$n<$width;$n++)
  {
    $array[$k][$n]=0;
  }
}

$array[0][0]=1;
$array[0][1]=0;
$array[0][2]=1;
$array[1][0]=0;
$array[1][1]=0;
$array[1][2]=1;
$array[2][0]=0;
$array[2][1]=0;
$array[2][2]=0;

for($k=0;$k<$height;$k++)
{
  echo "[";
  for($n=0;$n<$width;$n++)
  {
    if($n<$width-1)
    {
    echo $array[$k][$n],",";
    }
    else
    {
      echo $array[$k][$n];
    }
  }
  echo "]<br>";
}



$i=0;
while ($generation>$i)
{



for($k=0;$k<count($array);$k++)
{
  for($n=0;$n<count($array[$k]);$n++)
  {
    error_reporting(0); // array offsets
    //echo "life stage of [$k][$n] =";
    //echo lifeStage($array,$k,$n);
    //echo "<br>";
    $arrayAliveNeighbors[$k][$n]=lifeStage($array,$k,$n);
  }
}

for($k=0;$k<count($array);$k++)
{
  for($n=0;$n<count($array[$k]);$n++)
  {
    if($array[$k][$n]==1 && $arrayAliveNeighbors[$k][$n]<2) //dies because of underpopulation
    {
      $newGeneration[$k][$n]=0;
    }
    elseif($array[$k][$n]==1 && $arrayAliveNeighbors[$k][$n]>3) //dies because of overcrowding
    {
      $newGeneration[$k][$n]=0;
    }
    elseif($array[$k][$n]==1 && $arrayAliveNeighbors[$k][$n]<=3 && $arrayAliveNeighbors[$k][$n]>=2) // survieves
    {
      $newGeneration[$k][$n]=1;
    }
    elseif($array[$k][$n]==0 && $arrayAliveNeighbors[$k][$n]==3) // becomes alive because 3 neighbors
    {
      $newGeneration[$k][$n]=1;
    }
    else
    {
      $newGeneration[$k][$n]=$array[$k][$n];
    }
  }
}

$arrayAliveNeighbors=array(); // cleaning array
$array=$newGeneration; //
$i++; // i-th generation
}




/*
echo "<hr> Alive Neighbors<br>";



for($k=0;$k<$height;$k++)
{
  echo "[";
  for($n=0;$n<$width;$n++)
  {
    if($n<$width-1)
    {
    echo $arrayAliveNeighbors[$k][$n],",";
    }
    else
    {
      echo $arrayAliveNeighbors[$k][$n];
    }
  }
  echo "]<br>";
}
*/

echo "<br>";
$array=removeRow($array);


echo "<hr> New Generation<br>";

for($k=0;$k<$height;$k++)
{
  echo "[";
  for($n=0;$n<$width;$n++)
  {
    if($n<$width-1)
    {
    echo $array[$k][$n],",";
    }
    else
    {
      echo $array[$k][$n];
    }
  }
  echo "]<br>";
}

print_r($array);





 ?>
</body>
 </html>

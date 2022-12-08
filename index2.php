<?php
// Insertion sort (php)
function insert($my_array)
{
    for($i=0;$i<count($my_array);$i++){
        $val = $my_array[$i];
        $j = $i-1;
        while($j>=0 && $my_array[$j] > $val){
            $my_array[$j+1] = $my_array[$j];
            $j--;
        }
        $my_array[$j+1] = $val;
    }
return $my_array;
}
$test_array = array(3, 0, 2, 5, -1, 4, 1);
echo "Original Array :\n";
echo implode(', ',$test_array );
echo "\nSorted Array :\n";
print_r(insert($test_array));

// merge sort in PHP
$array = array(8,1,2,5,6,7);
print_array($array);
merge_sort($array);
print_array($array);

function merge_sort(&$list){
    if( count($list) <= 1 ){
        return $list;
    }

    $left =  array();
    $right = array();

    $middle = (int) ( count($list)/2 );

    // Make left
    for( $i=0; $i < $middle; $i++ ){
        $left[] = $list[$i];
    }

    // Make right
    for( $i = $middle; $i < count($list); $i++ ){
        $right[] = $list[$i];
    }

    // Merge sort left & right
    merge_sort($left);
    merge_sort($right);

    // Merge left & right
    return merge($left, $right);
}

function merge(&$left, &$right){
    $result = array();

    while(count($left) > 0 || count($right) > 0){
        if(count($left) > 0 && count($right) > 0){
            if($left[0] <= $right[0]){
                $result[] = array_shift($left);
            } else {
                $result[] = array_shift($right);
            }
        } elseif (count($left) > 0){
            $result[] = array_shift($left);
        } elseif (count($right) > 0){
            $result[] = array_shift($right);
        }
    }

    print_array($result);exit;

    return $result;
}

function print_array($array){
    echo "<pre>";
    print_r($array);
    echo "<br/>";
    echo "</pre>";
}
// kruskal

function kruskal_aa(array $graph): array
{
    $len = count($graph);
    $tree = [];

    $set = [];
    foreach ($graph as $k => $adj) {
        $set[$k] = [$k];
    }

    $edges = [];
    for ($i = 0; $i < $len; $i++) {
        for ($j = 0; $j < $i; $j++) {
            if ($graph[$i][$j]) {
                $edges[$i . ',' . $j] = $graph[$i][$j];
            }
        }
    }

    asort($edges);

    foreach ($edges as $k => $w) {
        list($i, $j) = explode(',', $k);

        $iSet = findSet($set, $i);
        $jSet = findSet($set, $j);
        if ($iSet != $jSet) {
            $tree[] = ["from" => $i, "to" => $j, "cost" => $graph[$i][$j]];
            unionSet($set, $iSet, $jSet);
        }
    }

    return $tree;
}

function findSet(array &$set, int $index)
{
    foreach ($set as $k => $v) {
        if (in_array($index, $v)) {
            return $k;
        }
    }

    return false;
}

function unionSet(array &$set, int $i, int $j)
{
    $a = $set[$i];
    $b = $set[$j];
    unset($set[$i], $set[$j]);
    $set[] = array_merge($a, $b);
}
/*  ex */
$one = [
    [0, 3, 1, 6, 0, 0],
    [3, 0, 5, 0, 3, 0],
    [1, 5, 0, 5, 6, 4],
    [6, 0, 5, 0, 0, 2],
    [0, 3, 6, 0, 0, 6],
    [0, 0, 4, 2, 6, 0]
];

$mst = kruskal_aa($one);

$minimumCost = 0;


foreach ($mst as $v) {
    echo "From {$v['from']} to {$v['to']} cost is {$v['cost']} <br>";
    $minimumCost += $v['cost'];
}

echo "Minimum cost: $minimumCost ";
    ?>



 

 









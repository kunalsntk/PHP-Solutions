function getMaxProfit($stockPrices)
{
    // calculate the max profit
    if(empty($stockPrices)){
        throw new Exception("Empty Stocks");
    }
    if(count($stockPrices)==1){
        throw new Exception("Single value");
    }
    $upStock = $stockPrices;
    sort($upStock);
    if($upStock == $stockPrices){
        return $stockPrices[count($stockPrices)-1]-$stockPrices[0];
    }
    $downStock = $stockPrices;
    rsort($downStock);
    if($downStock == $stockPrices){
        return ($stockPrices[1]-$stockPrices[0]);
    }
    
    $min = min($stockPrices);
    $max = max($stockPrices);
    
    if($min == $max){
        return 0;
    }
    
    $min_loc = array_search($min,$stockPrices);
    $max_loc = array_search($max,$stockPrices);
    
    if($min_loc < $max_loc){
        return ($max-$min);
    }
    else{
        $avail = array_slice($stockPrices,$max_loc+1,$min_loc);
        $next_max = max($avail);
        return $next_max - $max;
    }
    
    

    return 0;
}


















// tests

$desc = 'price goes up then down';
$actual = getMaxProfit([1, 5, 3, 2]);
$expected = 4;
assertEqual($actual, $expected, $desc);

$desc = 'price goes down then up';
$actual = getMaxProfit([7, 2, 8, 9]);
$expected = 7;
assertEqual($actual, $expected, $desc);

$desc = 'price goes up all day';
$actual = getMaxProfit([1, 6, 7, 9]);
$expected = 8;
assertEqual($actual, $expected, $desc);

$desc = 'price goes down all day';
$actual = getMaxProfit([9, 7, 4, 1]);
$expected = -2;
assertEqual($actual, $expected, $desc);

$desc = 'price stays the same all day';
$actual = getMaxProfit([1, 1, 1, 1]);
$expected = 0;
assertEqual($actual, $expected, $desc);

$desc = 'exception with empty prices';
$emptyArray = function() {
    getMaxProfit([]);
};
assertThrowsException($emptyArray, $desc);

$desc = 'exception with one price';
$onePrice = function() {
    getMaxProfit([1]);
};
assertThrowsException($onePrice, $desc);

function assertEqual($a, $b, $desc)
{
    if ($a === $b) {
        echo "$desc ... PASS\n";
    } else {
        echo "$desc ... FAIL: $a != $b\n";
    }
}

function assertThrowsException($func, $desc)
{
    try {
        $func();
        echo "$desc ... FAIL\n";
    } catch (Exception $e) {
        echo "$desc ... PASS\n";
    }
}

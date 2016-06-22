<?php
/*
  Return List of date between a period
  [2016-01-01, 2016-01-02, 2016-01-03, 2016-01-04, 2016-01-05]

*/
function getDateBetweenRange($start, $end){
    $dates = array($start);
    while(end($dates) < $end){
        $dates[] = changeDate(end($dates));
    }
    return $dates;
}
/*
  Increase or Decrease a Date by Fixed Interval like Date after 3 day or 10 day back Date
  2016-01-01 + 1 Day = 2016-01-02
*/
function changeDate($date, $step = 1){
  return date('Y-m-d', strtotime($date.' '.$step.' day'));
}
/*
  Find List of Missing Date Between a series of date Range
  ------------------Input-----------------
    $rangeArray = [
      [
        "start" => "2016-01-01",
        "end" => "2016-01-15"
      ],
      [
        "start" => "2016-01-12",
        "end" => "2016-01-27"
      ],
      [
        "start" => "2016-02-09",
        "end" => "2016-02-25"
      ],
      [
        "start" => "2016-03-09",
        "end" => "2016-03-25"
      ]

    ];
  ---------------------Processing------------------
    $dateList = getLeftOverDateBetweenRange($rangeArray);

  --------------------Output----------------------
      Array
    (
        [0] => 2016-01-28
        [1] => 2016-01-29
        [2] => 2016-01-30
        [3] => 2016-01-31
        [4] => 2016-02-01
        [5] => 2016-02-02
        [6] => 2016-02-03
        [7] => 2016-02-04
        [8] => 2016-02-05
        [9] => 2016-02-06
        [10] => 2016-02-07
        [11] => 2016-02-08
        [12] => 2016-02-26
        [13] => 2016-02-27
        [14] => 2016-02-28
        [15] => 2016-02-29
        [16] => 2016-03-01
        [17] => 2016-03-02
        [18] => 2016-03-03
        [19] => 2016-03-04
        [20] => 2016-03-05
        [21] => 2016-03-06
        [22] => 2016-03-07
        [23] => 2016-03-08
    )
*/

function getLeftOverDateBetweenRange($dateRangeArray){
  $opArray = [];
  foreach($dateRangeArray as $rangeKey => $rangeValue):
    $start = changeDate($rangeValue["end"]);
    if(isset($dateRangeArray[$rangeKey+1])):
      $end =  changeDate($dateRangeArray[$rangeKey+1]["start"], -1);
    else:
      break;
    endif;
    if($start < $end):
      $opArray = array_merge($opArray, getDateBetweenRange($start, $end));
    endif;
  endforeach;
  return $opArray;
}
/*
//Example

$rangeArray = [
  [
    "start" => "2016-01-01",
    "end" => "2016-01-15"
  ],
  [
    "start" => "2016-01-12",
    "end" => "2016-01-27"
  ],
  [
    "start" => "2016-02-09",
    "end" => "2016-02-25"
  ],
  [
    "start" => "2016-03-09",
    "end" => "2016-03-25"
  ]

];
$dateList = getLeftOverDateBetweenRange($rangeArray);
*/
?>

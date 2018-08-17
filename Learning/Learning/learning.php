// ===============================================================================

 <!-- Basic -->

<?php

echo "hello world";
//This is a single line comment
/*
this is a multiline comment
*/
$var1 = 5;
$var2 = 10;
$var3 = $var1 + $var2;
echo " this is a paragraph  ".$var3;
echo "string 1"."string2";
$bool = true;
$bool2 = false;
echo $bool;

define('PI', 3.14);    //constant

// ===============================================================================

// function

function func1()
{
    echo "This function prints something ";
}

function sum_numbers($num1, $num2)
{
    $sum = $num1 + $num2;
    return $sum;
}

echo "The sum of 1 and 3 is ". sum_numbers(1,3);

if (sum_numbers(1,6)==3)
{
    echo "is baar Duniya moh maaya hai";
}
elseif(sum_numbers(3,7)==43)
{
    echo "is baar bhi Duniya moh maaya hai";
}
else
{
    echo "Duniya moh maaya hai";
}

// ===============================================================================



// return
// function
// define
// echo
// \n or <br/>
// . is concating operator

// ==
// ===

<?php
// Explanation of the Steps:

// Main Function Logic:
//     Create a hashmap ($map) to store each number and its index as you iterate through the array.
//     For each number, calculate its complement ($target - $num) and check if it exists in the hashmap.
//     If it exists, return the indices of the current number and its complement.

// Unit Tests:
//     Each test method focuses on one scenario or input set.
//     assertEquals ensures that the output matches the expected result.

// Edge Cases:
//     Include tests for arrays with negative numbers and large datasets to ensure robustness.
function twoSum($nums, $target)
{
    $map = [];

    foreach ($nums as $index => $num) {
        $complement = $target - $num;
        if (array_key_exists($complement, $map)) {
            return [$map[$complement], $index];
        }
        $map[$num] = $index;
    }
    throw new Exception("No solution found");
}

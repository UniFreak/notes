<?php
// @?
// x30 = 48 = b0011 0000 = '0'
// x31 = 49 = b0011 0001 = '1'
var_dump(pack(str_repeat('H2', 10), ...range(30, 39))); // 0123456789


//          1         2         3         4         5
// 1234567890123456789012345678901234567890123456789012345678
// Date      |Description                | Income|Expenditure
// 01/28/2001 Flea spray                                24.99
// 01/29/2001 Camel rides to tourists      235.00

$table=<<<TABLE
Date      |Description                | Income|Expenditure
01/24/2001 Zed's Camel Emporium                    1147.99
01/28/2001 Flea spray                                24.99
01/29/2001 Camel rides to tourists      235.00            
TABLE;


$lines = explode("\n", $table);
array_shift($lines);
$total_inc = 0;
$total_exp = 0;
foreach ($lines as $line) {
    $record = unpack("A10date/x/A27desc/x/A7inc/x/A*exp", $line);
    var_dump($record);
    $total_inc += (float) $record['inc'];
    $total_exp += (float) $record['exp'];
}
// no space allowed
print(pack("A11A28A8A*", date('d/m/Y', time()), "Totals", $total_inc, $total_exp));
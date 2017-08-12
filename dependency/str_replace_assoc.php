<?php
#phpnet str-replace user wes foster
function str_replace_assoc(array $replace,$string){
    return
    str_replace(array_keys($replace),array_values($replace),$string);
}
?>
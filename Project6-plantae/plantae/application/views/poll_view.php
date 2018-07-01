<?php
    echo heading("Vote: favorite ".$poll_name, 3);
    echo "<input type='hidden' id='poll_id' value='".$poll_id."' />";
    
    foreach($poll_options as $option)
    {
        echo "<input type='button' name='poll_option' value='".$option["option_text"]."' data-option-id='".$option["option_id"]."' class='btnOption' title='Click to vote' />";
        echo br(1);
    }
?>
<div id="ajax-return" style="float: left;"></div>
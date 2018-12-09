<?php
    function is_multiple_array(array $arr) 
    {
        foreach ($arr as $rows) {
            if(!is_array($rows)) 
                return false;
        }
        return true;
    }

    function check_valid_values($fields, $values) 
    {
        $numFields = count($fields);
        foreach($values as $rows) {
            if(count($rows) != $numFields) {
                return false;
            }
        } 
        return true;
    }

    function round_half_integer(float $float) 
    {
        return floor($float * 2) / 2;
    }

    function print_rating($rating_point) 
    {
        $star = round_half_integer($rating_point);
        echo $star;
        while($star > 0) {
            if($star > 1) {
                echo '<span class="fa fa-star checked"></span>';
                $star -= 1;
            } 
            else {
                echo '<span class="fa fa-star-half-o" style="color:yellow"></span>';
                $star -= 0.5;
            }
        }        
        echo '<span class="course-ratings-count">(4 votes) </span>';
    }
?>
<?php

//validate.php
class Validate
{
    /*
     * validfoods
     */

    function validFood($food)
    {

        /*
        if(!empty($food) && ctype_alpha($food)) {
            return true;
        } else {
            return false;
        }
        */

        $food = str_replace(' ', '', $food);
        return !empty($food) && ctype_alpha($food);
    }

    /* Return a value indicating if meal is valid
       Valid meals are breakfast, lunch and dinner
       @param String $meal
       @return boolean
    */
    function validMeal($meal)
    {
        $meals = getMeals();
        return in_array($meal, $meals);
    }

    /*
    echo validMeal('breakfast') ? "yes<br>" : "no<br>";
    echo validMeal('') ? "yes<br>" : "no<br>";
    echo validMeal('dessert') ? "yes<br>" : "no<br>";
    echo validMeal('lunch') ? "yes<br>" : "no<br>";
    */
}

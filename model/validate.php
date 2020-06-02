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

    /** Return a value indicating if every value in
    the $selectedCondiments array is in the list of
    valid condiments.
    @param String[] $selectedCondiments
    @return boolean
     */
    function validCondiments($selectedCondiments)
    {
        $condiments = getCondiments();
        //print_r($selectedCondiments);
        //print_r($condiments);

        //We need to check each condiment in the selectedCondiments array
        foreach ($selectedCondiments as $selected) {
            if (!in_array($selected, $condiments)) {
                return false;
            }
        }
        return true;
    }
}

    /*
    echo validMeal('breakfast') ? "yes<br>" : "no<br>";
    echo validMeal('') ? "yes<br>" : "no<br>";
    echo validMeal('dessert') ? "yes<br>" : "no<br>";
    echo validMeal('lunch') ? "yes<br>" : "no<br>";
    */


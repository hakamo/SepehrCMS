<?php

/**
 * SlideGenerator short summary.
 *
 * SlideGenerator description.
 *
 * @version 1.0
 * @author Admin
 */

namespace app\Http\Controllers;


class SlideGenerator
{
    var $items = array();
    var $html  = array();	
    

    function __construct($items)
    {
        $this->items = $items;
    }

    function get_slides_html()
	{
        $count = 0;
        $_sequence = array('first-slide' , 'second-slide' , 'third-slide' , 'fourth-slide');


        //-------------------------------------------
        $this->html[] = '<ol class="carousel-indicators">';
        foreach ( $this->items as $item )
        {
            if($count == 0)
                $this->html[] = '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
            else
                $this->html[] = '<li data-target="#myCarousel" data-slide-to="'.$count.'"></li>';

            $count++;
        }
        $this->html[] = '</ol>';
        //-------------------------------------------

        $count = 0;

        foreach ( $this->items as $item )
        {
            if($count == 0)
                $this->html[] = '<div class="item active">';
            else
                $this->html[] = '<div class="item">';
            
            $this->html[] = '<img class="'. $_sequence[$count] .'" src="'.$item['FilePath'].'" alt="">';
            $this->html[] = '<div class="container">';
            $this->html[] = '<div class="carousel-caption">';
            $this->html[] = '<h1>'.$item['Title'].'</h1>';
            $this->html[] = '<p class="lead">'.$item['Description'].'</p>';
            $this->html[] = '<p><a class="btn btn-large btn-primary" href="'.$item['itemUrl'].'">'.$item['ButtonTitle'].'</a></p>';
            $this->html[] = '</div></div></div>';

            $count++;
        }
        
        echo htmlspecialchars_decode(implode( "\r\n", $this->html ));
    }    
}

?>
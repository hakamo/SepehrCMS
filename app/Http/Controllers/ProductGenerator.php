<?php

/**
 * ProductGenerator short summary.
 *
 * ProductGenerator description.
 *
 * @version 1.0
 * @author Admin
 */

namespace app\Http\Controllers;


class ProductGenerator
{
    var $items = array();
    var $html  = array();	

    function __construct($productItems)
    {
        $this->items = $productItems;
    }

    function get_products_html()
    {
        foreach ( $this->items as $item )
        {
            $this->html[] = '<div class="col-xs-12  col-sm-6 col-md-3">';
            $this->html[] = '<div class="thumbnail">';
            $this->html[] = '<img class="first-slide img-thumbnail  img-responsive" src="'.$item['product_picture_url'].'" alt="'.$item['product_title'].'">';
            $this->html[] = '<div class="caption">';
            $this->html[] = '<h3>'.$item['product_title'].'</h3>';
            $this->html[] = '<p>'.$item['product_description'].'</p>';
            $this->html[] = '<p><a href="'.$item['product_page_url'].'" class="btn btn-default" role="button">More</a></p>';
            $this->html[] = '</div></div></div>';
        }

        echo htmlspecialchars_decode(implode( "\r\n", $this->html ));
    }
}
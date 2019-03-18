<?php

/**
 * Generate HTML for multi-dimensional menu from MySQL database
 * with ONE QUERY and WITHOUT RECURSION 
 * @author J. Bruni
 */
namespace app\Http\Controllers;

class MenuGenerator
{
    //$sql = 'SELECT id, parent_id, title, link, position FROM menu_item ORDER BY parent_id, position;';
	/**
     * Menu items
     */
	var $items = array();
	
	/**
     * HTML contents
     */
	var $html  = array();	
    
    function __construct($menuItems)
    {
        $this->items = $menuItems;
    }
    
	/**
     * Build the HTML for the menu 
     */
	function get_menu_html( $root_id = 0 , $menuAttrib = "", $subAttrib = "")
	{
		$this->html  = array();
        $children = array();
		$counter = 0;

		foreach ( $this->items as $item )
        {            
            $children[$item['parentId']][] = $item;
            $counter++;
        }
        
		
		// loop will be false if the root has no children (i.e., an empty menu!)
		$loop = !empty( $children[$root_id] );
		
		// initializing $parent as the root
		$parent = $root_id;
		$parent_stack = array();
		
		// HTML wrapper for the menu (open)
		$this->html[] = '<ul '.$menuAttrib.'>';

        $counter = 0;
		
		while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_id ) ) )
		{
			if ( $option === false )
			{
				$parent = array_pop( $parent_stack );
				$this->html[] = '</ul>';
				$this->html[] = '</li>';
                $counter = 0;
			}
			elseif ( !empty( $children[$option['value']['linkId']] ) )
			{				                                            
                if($counter == 0)
                { 
                    $this->html[] = '<li class="dropdown">';
                    $this->html[] = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$option['value']['title'].'<b class="caret"></b></a>';
                    $this->html[] = '<ul class="dropdown-menu">';			
                    array_push( $parent_stack, $option['value']['parentId'] );
                    $parent = $option['value']['linkId'];
                    $counter++;
                    continue;
                }


                $this->html[] = '<li><a href=" ' . $option['value']['url'] .  '">' .$option['value']['title'] . '</a></li>';
                $this->html[] = '<ul class="dropdown-menu">';			
				array_push( $parent_stack, $option['value']['parentId'] );
				$parent = $option['value']['linkId'];
			}
			else
            {
                $this->html[] = '<li ><a href=" ' . $option['value']['url'] .  '">' . $option['value']['title'] . '</a></li>';
                //$counter = 0;
            }
            
		}
		
		// HTML wrapper for the menu (close)
		$this->html[] = '</ul>';
        
		echo htmlspecialchars_decode(implode( "\r\n", $this->html ));
	}

    function get_menu_zero($root_id = 0 )
    {    
        $this->html  = array();
        $children = array();
		$counter = 0;

		foreach ( $this->items as $item )
        {            
            $children[$item['parentId']][] = $item;
            $counter++;
        }
        
		
		// loop will be false if the root has no children (i.e., an empty menu!)
		$loop = !empty( $children[$root_id] );
		
		// initializing $parent as the root
		$parent = $root_id;
		$parent_stack = array();
		
		// HTML wrapper for the menu (open)
		$this->html[] = '<ul>';

        $counter = 0;
		
		while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_id ) ) )
		{
			if ( $option === false )
			{
				$parent = array_pop( $parent_stack );
				$this->html[] = '</ul>';
				$this->html[] = '</li>';
                $counter = 0;
			}
			elseif ( !empty( $children[$option['value']['linkId']] ) )
			{				                                            
                $this->html[] = '<li><a href="' . $option['value']['url'] .  '">' .$option['value']['title'] . '</a></li>';
                $this->html[] = '<ul class="dropdown-menu">';			
				array_push( $parent_stack, $option['value']['parentId'] );
				$parent = $option['value']['linkId'];
			}
			else
            {
                $this->html[] = '<li ><a href="' . $option['value']['url'] .  '">' . $option['value']['title'] . '</a></li>';
            }
            
		}
		
		// HTML wrapper for the menu (close)
		$this->html[] = '</ul>';
        
		echo htmlspecialchars_decode(implode( "\r\n", $this->html ));
    }
}

?>

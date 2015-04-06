<?php error_reporting(0);
function woopssfunc() {	
		$wooproductscroller_prodcat = array();
		
		$wooproductscroller_prodcat[] = get_option( 'wooproductscroller_prodcat');
		$no_of_prducts = get_option( 'wooproductscroller_no_of_products');
		$order_by = get_option( 'wooproductscroller_orderBy');
		if($order_by=='prod_title')
		{
			$order_by = 'title';
		}
		if($order_by=='prod_id')
		{
			$order_by = 'ID' ;
		}
		$order_	= get_option( 'wooproductscroller_order');

		if($wooproductscroller_prodcat[0]!='')
		{
		$pro_query = new WP_Query(array('post_type' => 'product','post_status' =>'publish','orderby' => $order_by,'order' => $order_ ,'posts_per_page' => $no_of_prducts,
		'tax_query' => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',
			'terms'    => $wooproductscroller_prodcat,
			'operator' => 'IN',
		),
	),) );
		}
		else
		{
		$pro_query = new WP_Query(array('post_type' => 'product','post_status' =>'publish','orderby' => $order_by,'order' => $order_ ,'posts_per_page' => $no_of_prducts) );	
		}
	
		 if ( $pro_query->have_posts() ) :
		 $signup_var = '';
		 $signup_var = '<div id="demo">
        <div class="container">
          <div class="row">
            <div class="span12">
			    <div id="owl-demo" class="owl-carousel">';
				while ( $pro_query->have_posts() ) : $pro_query->the_post();
			  	$signup_var .= '<div class="item"><a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_id(),array(300,200)).'</a>';
				if(get_option( 'wooproductscroller_title' )=='True')
				{
				$signup_var .= '<a href="'.get_permalink().'">'.get_the_title().'</a>';
				}
				$signup_var .= '</div>';
              	endwhile;
				wp_reset_postdata(); 
              $signup_var .= '</div>
	        </div>
          </div>
        </div>
     </div>';
	else:   $signup_var = 'no posts found';  endif; 	
	 /* Restore original Post Data */
		return $signup_var;
}?>
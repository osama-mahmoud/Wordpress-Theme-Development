<?php /* Template Name: categories */ ?>
<?php get_header(); ?>
<section id="category-2-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="category-2-items pt-10">
                        <div class="row">
                        <?php 
                    //     $categories = get_categories( array(
                    //     'orderby' => 'name',
                    //     'order'   => 'ASC',
                    //    // 'number' => 2,
                    //     ) );
                        // foreach( $categories as $category ) {
                        $args = array(            
                        'orderby' =>'date',
                        'order' =>'ASC',
                        'hide_empty'      => false,
                        );
                        $categories = get_categories($args);
                        $numOfItems = 2;
                        $page = isset( $_GET['categories'] ) ? abs( (int) $_GET['categories'] ) : 1;
                        $to = $page * $numOfItems ;
                        $current = $to - $numOfItems;
                        $total = sizeof($categories);
                        for ($i=$current; $i<$to; ++$i) {
                        $category = $categories[$i];
                        if( $category != ''){ 
                        ?>
                            <div class="col-md-3">
                                <div class="singel-items text-center mt-30">
                                    <div class="items-image">
                                        <img src="https://img.freepik.com/free-photo/book-with-green-board-background_1150-3836.jpg?w=2000" alt="Category">
                                    </div>
                                    <div class="items-cont">
                                        <a href="<?php echo get_category_link( $category->term_id ) ?>">
                                            <h5><?php echo $category->name //the_title()  ?></h5>
                                        </a>
                                    </div>
                                </div> <!-- singel items -->
                            </div>
                            <?php }  else{  ?> <div></div>  <?php   } }?>

                        </div> <!-- row -->
                    </div> <!-- category -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center">
                        <?php
                        unset($category);
                        $paginate_links = paginate_links( array(
                        'base'      => add_query_arg( 'categories', '%#%' ),
                        'format   ' => '',
                        'prev_text' => __('&laquo;'),
                        'next_text' => __('&raquo;'),
                        'total'     => ceil($total / $numOfItems),
                        'current'   => $page,
                        'type'      => 'array'
                         ));
                         if($paginate_links != ''){
                         foreach ( $paginate_links as $pgl ) {?>
                        <li class="page-item<?php if ( strpos( $pgl, 'current' ) !== false ) { echo ' active'; } ?>"><?php echo $pgl ?></li>
                       <?php } } ?> <div></div>  <?php 
                       ?> 
                        <div></div> <?php 
                       ?> 
                        </ul>
                    </nav>  <!-- courses pagination -->
                </div>
            </div>  <!-- row --><br>
        </div> <!-- container -->
</section>
<?php get_footer() ?>
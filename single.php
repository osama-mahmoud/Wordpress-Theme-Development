<?php get_header(); ?>
<section id="blog-singel" class="pt-90 pb-120 gray-bg">
        <div class="container">
           <div class="row">
              <div class="col-lg-8">
                  <div class="blog-details mt-30">
                      <div class="thum">
                    <img src="<?php setPostViews(get_the_ID()); echo get_the_post_thumbnail_url (); ?>" style="width:770px; height:420px;">
                      </div>
                      <div class="cont">
                          <h3><?php the_title(); ?></h3>
                          <ul class="post-info">
                              <!-- Get post author image -->
                              <li><a href="#"><i class="fa fa-image"></i><?php  echo get_avatar(get_the_author_meta('ID'),30)  ?></a></li>
                              <!-- Get post author -->
                              <li><a href="#"><i class="fa fa-user"></i> <?php the_post(); the_author_posts_link() ?></a></li>
                              <!-- Get post date -->
                              <li><a href="#"><i class="fa fa-calendar"></i><?php  echo get_the_date('j F Y', get_the_ID())  ?></a></li>
                              </a></li>
                               <!-- Get post tags -->
                               <li><a href="#"><i class="fa fa-tags"></i>
                               <?php
                                if(has_tag()) {
                                the_tags('Tags:&nbsp'); // &nbsp -> used to make space
                                } else {
                                echo "No Tags";
                                }
                                ?>
                                </a></li>
                              <!-- Get post categories separated by commas -->
                              <li><a href=""><i class="fa fa-list"></i><?php the_category(', ') ?></li>
                           </ul>
                           <!-- Get post descritpion -->
                           <p>
                               <?php the_content() ?>
                           </p>
                           <div class="blog-comment pt-45">
                               <div class="title pb-15">
                                   <!-- Get post comments number -->
                                   <h3>
                                       <?php 
                                       if( comments_open()){
                                       comments_number('0 Comments','1 Commnet','% Comments');
                                       }else {
                                       echo '<h3></h3>';
                                       }
                                       ?>
                                    </h3>
                               </div>  <!-- title -->
                               <!-- Get post comments -->
                                   <?php   comments_template() ?>
                           </div> <!-- blog comment -->
                      </div> <!-- cont -->
                  </div> <!-- blog details -->
              </div>
               <div class="col-lg-4">
                   <div class="saidbar">
                       <div class="row">
                           <div class="col-lg-12 col-md-6">
                               <div class="categories mt-30">
                                   <h4>Categories</h4>
                                   <ul>
                                      <?php 
                                      $categories = get_categories( array(
                                      'orderby' => 'name',
                                      'order'   => 'ASC',
                                      'number' => 10,
                                       ) );
                                       foreach( $categories as $category ) {
                                       ?>
                                       <li><a href="<?php echo get_category_link( $category->term_id ) ?>"><?php echo $category->name ?></a></li>
                                       <?php }?>
                                   </ul>
                               </div>
                           </div> <!-- categories -->
                       </div> <!-- row -->
                   </div> <!-- saidbar -->
               </div>
           </div> <!-- row -->
           <div class="row">
                <div class="col-lg-8">
                    <div class="releted-courses pt-95">
                        <div class="title">
                            <h3>Releted Courses</h3>
                        </div>
                        <div class="row">
                            <!-- Get related posts -->
                        <?php  
                        global $post;
                        $postcat = get_the_category( $post->ID );
                        $RelatedPosts = array(
                            'posts_per_page' => 2,
                            'orderby' => 'rand',
                            'post__not_in' => array(get_queried_object_id()), // post__not_in accept array only
                            'category__in' => wp_get_post_categories(get_queried_object_id()), // // category__in accept array only
                        );
                                     $wp_query = new WP_Query($RelatedPosts);
                                     while ($wp_query->have_posts()) : $wp_query->the_post();
                                 ?>
                                        <div class="col-md-6">
                                            <div class="singel-course mt-30">
                                                <div class="thum">
                                                    <div class="image">
                                                    <?php the_post_thumbnail('thumbnail') ?>
                                                    </div>
                                                </div>
                                                <div class="cont border">
                                                    <a href="<?php the_permalink() ?>"> <?php the_title('<h4>','</h4>'); ?></a>
                                                    <div class="course-teacher">
                                                        <div class="thum">
                                                        <?php  echo get_avatar( get_the_author_meta( 'ID' ), 42 );  ?>
                                                        </div>
                                                        <div class="name">
                                                            <a href=""><h6><?php the_author_posts_link() ?></h6></a>
                                                        </div>
                                                        <div class="admin">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-user"></i><span>31</span></a></li>
                                                                <li><a href="#"><i class="fa fa-heart"></i><span>10</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- singel course -->
                                        </div>
                                        <?php
                                     endwhile;
                     ?>
                        </div> <!-- row -->
                    </div> <!-- releted courses -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
<?php get_footer(); ?>
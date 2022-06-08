<?php get_header()  ?>
<!--====== SLIDER PART START ======-->
<section id="slider-part" class="slider-active">
                    <!-- Loop post type slider to show sliders -->
                    <?php 
                    $values =  array('post_type'=>'slider');
                    $query = new WP_Query($values);
                    if($query -> have_posts()){
                    while($query -> have_posts()): $query->the_post(); 
                    $url = wp_get_attachment_url( get_post_thumbnail_id($query->ID), 'thumbnail' );
                    ?>
        <div class="single-slider slider-2 bg_cover" style="background-image: url(<?php echo $url ?>)" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s"><?php the_title(); ?></h1>
                            <h4 data-animation="fadeInUp" data-delay="1.3s"><?php the_content();  ?></h4>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- single slider -->
        <?php endwhile; } ?>
</section>

<?php setPostViews(get_the_ID());  ?>
<section id="courses-part" class="pt-120 pb-120 gray-bg">
        <div class="container">
        <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-45">
                        <h2>Most popular posts </h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                    <div class="row">
                        <?php  
                        $args = array(
                                'post_type'=>'post',
                                'posts_per_page' => 6,
                                'meta_key' => 'post_views_count',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC'
                                 );
                         $values = $args;
                         $wp_query = new WP_Query($values);
                       while ($wp_query->have_posts()) : $wp_query->the_post();
                    //    echo "<pre>";
                    //    print_r($wp_query);
                    //    echo "</pre>";
    ?>  

                        <div class="col-lg-4 col-md-6">
                            <div class="singel-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <!-- <img src="" alt="Course"> -->
                                        <?php the_post_thumbnail('thumbnail') ?>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="<?php the_permalink() ?>">
                                    <?php the_title('<h4>','</h4>'); ?>
                                    </a>
                                    <div class="course-teacher">
                                    <?php  echo get_avatar( get_the_author_meta( 'ID' ), 42 );  ?>
                                        <div class="name">
                                            <a href=" "><h6><?php the_author_posts_link() ?></h6></a>
                                        </div>
                                        <div class="admin">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-comments"></i><span>
                                                    <?php comments_popup_link() ?>
                                                </span></a></li>
                                                <li><a href="#"><i class=""></i><span><?php the_excerpt() ?></span></a></li>
                                                <a href="<?php echo get_permalink(); ?>">Read More</a>
                                            </ul>
                                            <h6>
                                                <?php
                                                  if(has_tag()) {
                                                    the_tags();
                                                } else {
                                                    echo "No Tags";
                                                }
                                                ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- singel course -->
                        </div>
                        <?php
                     endwhile; wp_reset_postdata();
                     ?>
                    </div>
                </div>
            </div>                     
        </div> <!-- container -->
</section>
    <!--====== COURSE PART START ======-->
    <section id="course-part" class="pt-115 pb-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-45">
                        <h5>Our course</h5>
                        <h2>Featured courses </h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row course-slied mt-30">
                <!-- Loop posts that has Featured courses checked  -->
                        <?php  
                         $values =  array(
                         'post_type'=>'post',
                         'posts_per_page' => 4,  // how many post show per page
                         'meta_query' => array(  // meta_query used with custom field
                            array(
                                'key'     => 'metaeditor', // featured_courses is custom field in post type (post)
                                'value'   => 'on',
                            ),
                        ));
                         $wp_query = new WP_Query($values);
                         while ($wp_query->have_posts()) : $wp_query->the_post();
                        ?>
                <div class="col-lg-4">
                    <div class="singel-course-2">
                        <div class="thum">
                            <div class="image">
                            <?php the_post_thumbnail('medium_large') ?>
                            </div>
                            <div class="course-teacher">
                                <div class="thum">
                                <?php  echo get_avatar( get_the_author_meta( 'ID' ), 42 );  ?>
                                </div>
                                <div class="name">
                                <a href=" "><h6 class="FeaturedCoursesAutherName"><?php the_author_posts_link() ?></h6></a>
                                </div>
                            </div>
                        </div>
                        <div class="cont">
                        <a href="<?php the_permalink() ?>"><?php the_title('<h4>','</h4>'); ?></a>
                        </div>
                    </div> <!-- singel course -->
                </div>
                <?php endwhile; ?>
            </div> <!-- course slied -->
        </div> <!-- container -->
    </section>
<?php get_footer() ?>
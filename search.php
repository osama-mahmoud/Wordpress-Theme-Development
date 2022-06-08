<?php get_header(); ?>
<section id="courses-part" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                    <div class="row">
                    <?php
        $s=get_search_query();
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
        $args = array(
        's' =>$s,
        'paged' => $paged,
        );
        // The Query
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
         //  _e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
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
        }
    }
?>
                   
                        <?php
                    //  endwhile;
                     ?>
                    </div>
                </div>
            </div>                     
            <div class="row">
                <div class="col-lg-12">
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center">
                        <?php    
                        $pages = array(
                        'type' => 'array',
                        'prev_text'    => 'prev',
                        'next_text'    => 'next',
                         );
                        $links = paginate_links($pages);
                        if($links != ''){
                        foreach($links as $key => $page_link):?>
                        <li class="page-item<?php if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; } ?>"><?php echo $page_link ?></li>
                        <?php endforeach; } else { ?> <div></div>  <?php } ?>
                        </ul>
                    </nav>  <!-- courses pagination -->
                </div>
            </div>  <!-- row -->
        </div> <!-- container -->
</section>
<?php get_footer(); ?>
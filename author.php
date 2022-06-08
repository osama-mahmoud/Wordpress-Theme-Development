<?php get_header(); ?>
<section id="teachers-singel" class="pt-70 pb-120 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="teachers-left mt-50">
                        <div class="hero">
                        <?php  echo get_avatar(get_the_author_meta('ID'))  ?>
                        </div>
                        <div class="name">
                            <h6><?php the_post(); the_author_meta('nickname')  ?> <!-- Display user nickname  --></h6>
                        </div>
                        <div class="description">
                            <p><?php the_post(); the_author_meta('description')  ?> <!-- Display user nickname  --></p>
                        </div>
                    </div> <!-- teachers left -->
                </div>
                <div class="col-lg-8">
                    <div class="teachers-right mt-50">
                        <ul class="nav nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="active" id="courses-tab"  aria-controls="courses" aria-selected="false">Courses</a>
                            </li>
                        </ul> <!-- nav -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                                <div class="courses-cont pt-20">
                                    <div class="row">
                                    <?php  
                                     $wp_query = new WP_Query(array('paged'=> $paged,'author' => get_the_author_meta('ID')));
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
                                </div> <!-- courses cont -->
                            </div>
                        </div> <!-- tab content -->
                    </div> <!-- teachers right -->
                </div>
                <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center">
                        <?php    
                        $pages = array(
                        'type' => 'array',
                        'prev_text'    => 'prev',
                        'next_text'    => 'next',
                         );
                        $links = paginate_links($pages);
                        foreach($links as $key => $page_link):?>
                        <li class="page-item<?php if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; } ?>"><?php echo $page_link ?></li>
                        <?php endforeach ?>
                        </ul>
                    </nav>  <!-- courses pagination -->
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
<?php get_footer(); ?>
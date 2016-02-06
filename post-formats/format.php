
              <?php
                /*
                 * This is the default post format.
                 *
                 * So basically this is a regular post. if you don't want to use post formats,
                 * you can just copy ths stuff in here and replace the post format thing in
                 * single.php.
                 *
                 * The other formats are SUPER basic so you can style them as you like.
                 *
                 * Again, If you want to remove post formats, just delete the post-formats
                 * folder and replace the function below with the contents of the "format.php" file.
                */
              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
                
                          <!-- Post details -->
                          <div class="blog-single--post-details row">
                            <div class="col">
                              <ul class="post-details--meta no-list">
                                                                        <?php 
                                                                        $categories = get_the_category();//fetch the category
                                                                        $cat = my_category($categories);
                                                                        ?>
                                <li><span>В рубрике: </span><a href="<?=$cat[link];?>"><?=$cat[name];?></a></li>
                                <li><span>Автор: </span><a href="/<?=get_the_author_link( get_the_author_meta( 'ID' ) );?>"><?=get_the_author_link( get_the_author_meta( 'ID' ) );?></a></li>
                              </ul>
                            </div>
                            <div class="col text-right">
                                <!-- Time published -->
                                <div class="blog-single--post-details--published">
                                  <span class="post-details--date"><?=get_the_time('Y-m-d');?></span>
                                </div>
                              </div>
                              
                            </div>  <!-- /.Post details -->                    
                          
                          <!-- Single title -->
                          <h1 class="text-center"><?php the_title(); ?></h1>
                          
                         <!-- Post ft img -->
                        <div class="blog-single--post-main-img">
                          <?=the_post_thumbnail('large');?>
                        </div>

                          
                          <!-- Content! -->
                          <div class="single-entry-content">
                            <?=the_content();?>
                          </div>
       
               

                  <p class="byline entry-meta vcard">

                    <?php /*
                      printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                     */
                       /* the time the post was published */
                       /*'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',   */
                       /* the author of the post */
                       /*'<span class="by">'.__( 'by', 'bonestheme' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'*/
                               
                    //);  
                       ?>

                  </p>


                <footer class="article-footer">

                  <?php //printf( __( 'filed under', 'bonestheme' ).': %1$s', get_the_category_list(', ') ); ?>

                    <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                </footer> <?php // end article footer ?>

                <?php //comments_template(); ?>

              </article> <?php // end article ?>

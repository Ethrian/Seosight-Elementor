<?php
if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Seosight
 */
if ( !function_exists( 'seosight_posted_time' ) ) :

    function seosight_posted_time( $icon = true ) {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date  updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
        );

        $icon_html = (true === $icon) ? '<i class="seoicon-clock"></i>' : '';

        return sprintf(
        '<span class="post__date">' . $icon_html . $time_string . '</span>'
        );
    }

endif;

if ( !function_exists( 'seosight_grid_post_author' ) ) :

    function seosight_grid_post_author() {
        global $post;
        $nickname = get_the_author_meta( 'nickname' );
        if ( $nickname ) {
            echo get_avatar( $post->post_author, 30, '', $post->post_title, array(
                'class' => 'avatar avatar-40 photo'
            ) );
            ?>
            <div class="post__author-name fn">
                <?php esc_html_e( 'Posted by', 'seosight' ); ?>
                <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" title="test" class="post__author-link"><?php echo esc_html( $nickname ); ?></a>
            </div>
        <?php } ?>
        <div class="more-link">
            <a href="<?php echo the_permalink(); ?>"><i class="seoicon-right-arrow"></i></a>
        </div>
        <?php
    }

endif;

if ( !function_exists( 'seosight_grid_title_with_post_meta' ) ) :

    function seosight_grid_title_with_post_meta() {
        global $post;

        $show_meta = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'blog-meta-show', 'yes' ) : 'yes';
        if ( is_single() ) {
            $show_meta = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'single-meta-show', 'yes' ) : 'yes';
        }
        if ( 'yes' === $show_meta ) {
            if ( 'post' === get_post_type() ) {
                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list( esc_html__( ', ', 'seosight' ) );
                if ( $categories_list && seosight_categorized_blog() ) {
                    echo( '<span class="category"><i class="seoicon-tags"></i>' . $categories_list . '</span>' ); // WPCS: XSS OK.
                }
            }
        }
        the_title( '<h2 class="post__title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        if ( 'yes' === $show_meta ) {
            echo '<div class="post-additional-info">';
            echo seosight_posted_time();

            if ( !post_password_required() && ( comments_open() || get_comments_number() ) ) {
                echo '<span class="post__comments">';
                /* translators: %s: post title */
                comments_popup_link( '<i class="fa fa-comment-o" aria-hidden="true"></i> 0', '<i class="fa fa-comment-o" aria-hidden="true"></i> 1', '<i class="fa fa-comment-o" aria-hidden="true"></i> %', 'comments-link', false );
                echo '</span>';
            }
            echo '</div>';
        }
    }

endif;

if ( !function_exists( 'seosight_posted_on' ) ) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function seosight_posted_on() {
        $show_meta = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'blog-meta-show', 'yes' ) : 'yes';
        if ( is_single() ) {
            $show_meta = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'single-meta-show', 'yes' ) : 'yes';
        }
        if ( 'yes' === $show_meta ) {

            echo seosight_posted_time();

            if ( 'post' === get_post_type() ) {
                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list( esc_html__( ', ', 'seosight' ) );
                if ( $categories_list && seosight_categorized_blog() ) {
                    echo( '<span class="category"><i class="seoicon-tags"></i>' . $categories_list . '</span>' ); // WPCS: XSS OK.
                }
            }

            if ( !post_password_required() && ( comments_open() || get_comments_number() ) ) {
                echo '<span class="post__comments">';
                /* translators: %s: post title */
                comments_popup_link( '<i class="fa fa-comment-o" aria-hidden="true"></i> 0', '<i class="fa fa-comment-o" aria-hidden="true"></i> 1', '<i class="fa fa-comment-o" aria-hidden="true"></i> %', 'comments-link', false );
                echo '</span>';
            }
        }
    }

endif;
if ( !function_exists( 'seosight_post_author_avatar' ) ) :

    /**
     * Generate html markup for post author display.
     *
     * @param $author_id int Id of author
     */
    function seosight_post_author_avatar( $author_id ) {
        $show_author = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'blog-author-show', 'yes' ) : 'yes';
        if ( is_single() ) {
            $show_author = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'single-author-show', 'yes' ) : 'yes';
        }

        if ( !is_author() && 'yes' === $show_author ) {
            ?>
            <div class="post__author author vcard">
                <?php echo get_avatar( $author_id, 40 ); ?>
                <div class="post__author-name fn">
                    <?php esc_html_e( 'Posted by', 'seosight' ); ?>
                    <a href="<?php echo get_author_posts_url( $author_id ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>" class="post__author-link"><?php the_author_meta( 'display_name', $author_id ); ?></a>
                </div>
            </div>
            <?php
        }
    }

endif;
if ( !function_exists( 'seosight_entry_footer' ) ) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function seosight_entry_footer() {
        $tags_list = get_the_tag_list( '', ' ' );
        if ( $tags_list ) {
            printf( '<div class="post-tags w-tags"><div class="tags-wrap">%1$s</div></div>', $tags_list ); // WPCS: XSS OK.
        }

        edit_post_link(
        sprintf(
        /* translators: %s: Name of current post */
        esc_html__( 'Edit "%s"', 'seosight' ), get_the_title()
        ), '<span class="edit-link">', '</span>'
        );
    }

endif;

if ( !function_exists( 'seosight_logo' ) ):

    /**
     * Returns logotype markup depends on theme options.
     *
     */
    function seosight_logo() {
        $logo_image_style = '';

        $logo_image    = '';
        $logo_retina   = false;
        $logo_title    = get_bloginfo( 'name' );
        $logo_subtitle = get_bloginfo( 'description' );

        if ( function_exists( 'fw_get_db_customizer_option' ) ) {
            $logo_image    = fw_get_db_customizer_option( 'logo-image/url' );
            $logo_retina   = fw_get_db_customizer_option( 'logo-retina' );
            $logo_title    = fw_get_db_customizer_option( 'logo-title', $logo_title );
            $logo_subtitle = fw_get_db_customizer_option( 'logo-subtitle', $logo_subtitle );
        }
        if ( true === $logo_retina && !empty( $logo_image ) ) {
            $logo_id    = fw_get_db_customizer_option( 'logo-image/attachment_id' );
            $image_atts = wp_get_attachment_metadata( $logo_id );

            $logo_image_style = 'style="width:' . intval( $image_atts[ 'width' ] / 2 ) . 'px; height:' . intval( $image_atts[ 'height' ] / 2 ) . 'px;"';
        }

        echo '<a href="' . esc_url( home_url( '' ) ) . '" class="full-block-link" rel="home"></a>';
        if ( !empty( $logo_image ) ) {
            echo '<img src="' . esc_html( $logo_image ) . '" alt="' . get_bloginfo( 'name' ) . '" ' . $logo_image_style . '/>';
        }
        if ( !empty( $logo_title ) || !empty( $logo_subtitle ) ) {
            echo '<div class="logo-text">';
            if ( !empty( $logo_title ) ) {
                echo '<div class="logo-title">' . esc_html( $logo_title ) . '</div>';
            }
            if ( !empty( $logo_subtitle ) ) {
                echo '<div class="logo-sub-title">' . esc_html( $logo_subtitle ) . '</div>';
            }
            echo '</div>';
        }
    }

endif;
if ( !function_exists( 'seosight_additional_nav' ) ):

    function seosight_additional_nav() {
        $show_search  = 'yes';
        $search_style = 'fullscreen';

        if ( function_exists( 'fw_get_db_customizer_option' ) ) {
            $show_search  = fw_get_db_customizer_option( 'search-icon/value', 'yes' );
            $search_style = fw_get_db_customizer_option( 'search-icon/yes/style', 'fullscreen' );
        }

        if ( class_exists( 'WooCommerce' ) || 'yes' === $show_search ) {
            ?>
            <ul class="nav-add">
                <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                    <li class="cart">
                        <?php get_template_part( 'template-parts/shop', 'cart' ); ?>
                    </li>
                <?php } ?>
                <?php
                if ( 'yes' === $show_search ) {
                    $icon_class = 'fullscreen' === $search_style ? 'js-open-search' : 'js-open-p-search';
                    echo '<li class="search search_main"><a href="#" class="' . esc_attr( $icon_class ) . '"><i class="seoicon-loupe"></i></a></li>';
                    if ( 'dropdown' === $search_style ) {
                        get_template_part( 'template-parts/search', $search_style );
                    }
                }
                ?>

            </ul>

            <?php
        }
    }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function seosight_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'seosight_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'seosight_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so seosight_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so seosight_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in seosight_categorized_blog.
 */
function seosight_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'seosight_categories' );
}

add_action( 'edit_category', 'seosight_category_transient_flusher' );
add_action( 'save_post', 'seosight_category_transient_flusher' );

/**
 * Adds 'class="prev" to the previous comments link.
 *
 * @since 0.1.0
 * @param string $attributes The previous comments link attributes.
 * @return string
 */
function seosight_previous_comments_link_attributes( $attributes ) {
    return $attributes . ' class="btn-prev-wrap"';
}

/**
 * Adds 'class="next" to the next comments link.
 *
 * @since 0.1.0
 * @param string $attributes The next comments link attributes.
 * @return string
 */
function seosight_next_comments_link_attributes( $attributes ) {
    return $attributes . ' class="btn-next-wrap"';
}

/* Add classes to the comments pagination. */
add_filter( 'previous_comments_link_attributes', 'seosight_previous_comments_link_attributes' );
add_filter( 'next_comments_link_attributes', 'seosight_next_comments_link_attributes' );

if ( !function_exists( 'seosight_comments' ) ) :

    /**
     * seosight List Comments Callback
     * callback function for wp_list_comments in seosight/comments.php
     *
     * @param object $comment Comment object.
     * @param array  $args    Arguments for callback.
     * @param int    $depth   Max. depth of comments tree.
     */
    function seosight_comments( $comment, $args, $depth ) {
        do_action( 'seosight_comments', $comment, $args, $depth );
        $GLOBALS[ 'comment' ] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class( 'comments__item' ); ?> id="comment-<?php comment_ID(); ?>">
                    <div class="comment-content post-content comment">
                        <h5><?php esc_html_e( 'Pingback:', 'seosight' ); ?><?php comment_author_link(); ?> </h5>
                        <?php edit_comment_link( esc_html__( 'Edit', 'seosight' ), '<div class="simple-article small"><span>', '</span></div>' ); ?>
                    </div>
                </li>

                <?php
                break;
            default :
                // Proceed with normal comments.
                global $comment_depth;
                global $allowedtags;

                if ( '1' === $comment_depth ) {
                    $reply_comment = '';
                } else {
                    $reply_comment = ' reply-comment';
                }
                ?>

                <li <?php comment_class( 'comments__item' . $reply_comment ); ?> id="div-comment-<?php comment_ID(); ?>">
                    <?php if ( '0' === $comment->comment_approved ) : ?>
                        <h5 class="comment-awaiting-moderation"> <?php esc_html_e( 'Your comment is awaiting moderation.', 'seosight' ); ?></h5>
                    <?php endif; ?>

                    <article <?php comment_class( 'comment-entry comment comments__article' ) ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">

                        <div class="comment-content post-content comment" itemprop="text">
                            <?php echo wp_kses( get_comment_text(), $allowedtags ) ?>
                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                <p class="comment-meta-item"><?php esc_html_e( 'Your comment is awaiting moderation.', 'seosight' ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="comments__body display-flex">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class=" seoicon-arrow-back"></i>', 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ), $comment->comment_ID ) ?>
                            <figure class="comments__avatar"><?php echo get_avatar( $comment, 70 ); ?></figure>
                            <header class="comment-meta comments__header">
                                <cite class="fn url comments__author">
                                    <a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
                                </cite>
                                <div class="comments__time">
                                    <time class="comment-meta-item" datetime="<?php comment_date( 'Y-m-d' ) ?>T<?php comment_time( 'H:iP' ) ?>" itemprop="datePublished"><?php comment_date() ?>, <a
                                            href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
                                </div>
                                <?php edit_comment_link( esc_html__( 'Edit this comment', 'seosight' ), '', '' ); ?>
                            </header>
                        </div>
                    </article>
                </li>
                <!-- #comment-## -->
                <?php
                break;
        endswitch; // End comment_type check. 
        ?>
        <?php
    }


























endif;


<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package BzoTech-Framework
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}
if(!function_exists('bzotech_comments_list'))
{ 
    function bzotech_comments_list($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;
        /* override default avatar size */
        $args['avatar_size'] = 120;
        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) :
            ?>
            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                <div class="comment-body">
                    <?php esc_html_e('Pingback:', 'bw-petito'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('Edit', 'bw-petito'), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>'); ?>
                </div>
        <?php else : ?>
            <li <?php comment_class(empty($args['has_children']) ? '' : 'parent' ); ?>>
                <div id="comment-<?php comment_ID(); ?>" class="item-comment flex-wrapper">
                    <div class="comment-thumb vcard">
                        <?php
                            if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] );
                        ?>
                    </div>					
					<div class="comment-info">
                        <?php printf(esc_html__('%s', 'bw-petito'), sprintf('<div class="author-name">%s<span>'.esc_html__("Posted on: ",'bw-petito').''.get_comment_time('M d, Y').'</span></div>', get_comment_author_link())); ?>
						<div class="content-comment clearfix"><?php comment_text();?></div>
						
						<?php if (comments_open()): ?>
                            <?php echo str_replace('comment-reply-link', 'comment-reply-link reply-button', get_comment_reply_link(array_merge( $args, array('reply_text' =>esc_html__('Reply','bw-petito'),'depth' => $depth, 'max_depth' => $args['max_depth'])))) ?>
						<?php endif; ?>
					</div>
				</div>
        <?php
        endif;
    }
}

if ( have_comments() ) : ?>
    <div id="comments" class="comments-area comments bzotech-blog-list-comment">
		<h3 class="anton title-comment-post"><span>
            <?php printf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'bw-petito' ),number_format_i18n( get_comments_number() ));?></span>
        </h3>
        <div class="comments">
        	<ul class="comment-list list-none">
	            <?php
	            wp_list_comments(array(
	                'style' 		=> '',
	                'short_ping' 	=> true,
	                'avatar_size' 	=> 70,
	                'max_depth' 	=> '5',
	                'callback' 		=> 'bzotech_comments_list',
	            ));
	            ?>
	        </ul>
        </div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bw-petito' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'bw-petito' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'bw-petito' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>
    </div><!-- #comments -->
<?php endif; // have_comments() ?>

<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bw-petito' ); ?></p>
<?php endif; ?>

<?php
$comment_form = array(
    'title_reply' => esc_html__('Leave a comment', 'bw-petito'),
    'fields' => apply_filters( 'comment_form_default_fields', array(
            'author' =>	'<p class="contact-name">
                            <span class="title-label">'.esc_html__("Name*",'bw-petito').'</span>
                            <input class="border" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" placeholder="'.esc_attr__( 'Name*', 'bw-petito' ).'"/>
                        </p>',
            'email' =>	'<p class="contact-email">
                            <span class="title-label">'.esc_html__("Email*",'bw-petito').'</span>
                            <input class="border" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'.esc_attr__( 'Email*', 'bw-petito' ).'"/>
                        </p>',
            'url' =>	'<p class="contact-site">
                            <span class="title-label">'.esc_html__("Web Site",'bw-petito').'</span>
                            <input class="border" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'/>
                        </p>',
        )
    ),
    'comment_field' =>  '<p class="contact-message">
                            <span class="title-label">'.esc_html__("Comment",'bw-petito').'</span>
                            <textarea id="comment" class="border" rows="5" name="comment" aria-required="true" placeholder="'.esc_attr__( 'Your comment*', 'bw-petito' ).'"></textarea>
                        </p>',
    'must_log_in' => '<div class="must-log-in control-group"><p class="desc silver">' .sprintf(wp_kses_post(__( 'You must be <a href="%s">logged in</a> to post a comment.','bw-petito' )),wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )) . '</p></div >',
    'logged_in_as' => '<div class="logged-in-as control-group"><p class="desc silver">' .sprintf(wp_kses_post(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','bw-petito' )),admin_url( 'profile.php' ),$user_identity,wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )) . '</p></div>',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit',
    'title_reply'          => esc_html__( 'Leave a comment','bw-petito' ),
    'title_reply_to'       => esc_html__( 'Leave a Reply %s','bw-petito' ),
    'cancel_reply_link'    => esc_html__( 'Cancel reply','bw-petito' ),
    'label_submit'         => esc_html__( 'Post comment','bw-petito' ),
    'class_submit'         => 'elbzotech-bt-default',
    'class_container'         => "comment-respond leave-comments reply-comment bzotech-blog-form-comment",
    'title_reply_before'=>'<h3 id="reply-title" class="title-comment-post comment-reply-title"><span>',
    'title_reply_after'=>'</span></h3>'
);
//get comment form
comment_form($comment_form); 


class bzotech_custom_comment extends Walker_Comment {
     
    /** START_LVL 
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array() ) {       
        $GLOBALS['comment_depth'] = $depth + 1;

           $output .= '<div class="children">';
        }
 
    /** END_LVL 
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '</div>';
    }
    function end_el( &$output, $object, $depth = 0, $args = array() ) {
    	$output .= '';
    }
}
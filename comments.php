<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

    <h3 class="comments-title">
      <?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					_e( 'One comment', 'gimliii' );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s comment',
							'%1$s comments',
							$comments_number,
							'comments title',
							'gimliii'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
    </h3>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'gimliii' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'gimliii' ) ); ?></div>
    </nav><!-- #comment-nav-above -->
    <?php endif; // Check for comment navigation. ?>

    <ol class="comment-list">
        <?php
            wp_list_comments(
               'callback=gimliii_comment'
            );
        ?>
    </ol><!-- .comment-list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'gimliii' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'gimliii' ) ); ?></div>
    </nav><!-- #comment-nav-below -->
    <?php endif; // Check for comment navigation. ?>

    <?php if ( ! comments_open() ) : ?>
    <p class="no-comments"><?php _e( 'Comments are closed.', 'gimliii' ); ?></p>
    <?php endif; ?>

    <?php endif; // have_comments() ?>
</div><!-- #comments -->
 <?php
        $aria_req= 'aria-required="true"';
        $gimliii_comment_filed = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun','gimliii' ) .
    '</label><div class="row margin-bottom-20">
        <div class="col-md-7 col-md-offset-0">
            <textarea   id="comment" class="form-control" name="comment"  rows="8" aria-required="true"></textarea>
        </div>
    </div></p>';
         $gimliii_com_fields =  array(
    'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name','gimliii' ) . '</label> ' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<div class="row margin-bottom-20">
       <div class="col-md-7 col-md-offset-0">
           <input  type="text"  class="form-control" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' >
        </div>
      </div></p>',
    'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ,'gimliii' ) . '</label> ' .
    ( $req ? '<span class="required">*</span>' : '' ) .
        '<div class="row margin-bottom-20">
            <div class="col-md-7 col-md-offset-0">
                <input  type="text"  class="form-control" id="email" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' >
            </div>
         </div></p>'
);
    comment_form( array(
            'fields'       => $gimliii_com_fields,
            'comment_notes_after' => '',
             'comment_field' => $gimliii_comment_filed,
            'title_reply'  =>  __('Leave a Reply','gimliii'),
            'label_submit' => __(' Send Comment','gimliii')
        )
    );
?>

<?php
// $fields = array(
//     'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'responsive' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
//     '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',
//     'email'  => '<p class="comment-form-email"><label for="email">' . __( 'E-mail', 'responsive' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
//     '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" /></p>',
//     'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'responsive' ) . '</label>' .
//     '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
// );

// $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', $fields ),'label_submit'=>__('Add a comment') );

// comment_form( $defaults );
?>

<?php if ( have_comments() ) : ?>
	<h3 class="comments-title">Comments</h3>
	
	<?php 

	$args = array(
	'walker'            => null,
	'max_depth'         => '',
	'style'             => 'div',
	'callback'          => 'mytheme_comment',
	'end-callback'      => null,
	'type'              => 'all',
	'reply_text'        => 'Reply',
	'page'              => '',
	'per_page'          => '',
	'avatar_size'       => 0,
	'reverse_top_level' => null,
	'reverse_children'  => '',
	'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
	'short_ping'        => false,   // @since 3.6
        'echo'              => true     // boolean, default is true
);

	wp_list_comments($args);  ?>

<?php endif; ?>

<?php 
 $fields =  array(
 				'label_submit'      => __( 'Add A Comment' ),
			);
//   'author' =>
//     '<p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
//     ( $req ? '<span class="required">*</span>' : '' ) .
//     '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
//     '" size="30"' . $aria_req . ' /></p>',

//   'email' =>
//     '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
//     ( $req ? '<span class="required">*</span>' : '' ) .
//     '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
//     '" size="30"' . $aria_req . ' /></p>',

//   'url' =>
//     '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
//     '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
//     '" size="30" /></p>',
// );

comment_form($fields); ?>
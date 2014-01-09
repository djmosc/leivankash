<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php if ( comments_open() ) : ?>

<div id="reviews">

	<div id="comments">
		
		<?php $title_reply = ''; ?>

		<?php if ( have_comments() ) : ?>
			<h3 class="title text-center"><?php _e( 'Reviews', 'woocommerce' ); ?></h3>
			<ol class="commentlist">

			<?php wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );?>

			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'woocommerce' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'woocommerce' ) ); ?></div>
			</div>
			<?php endif; ?>
		
		<?php endif; ?>

			<footer class="reviews-footer add_review clearfix">
				<div class="inner clearfix">
					<p class="text-right">
						<a href="#review_form" class="inline show_review_form white-btn"><?php _e( 'Write a review', 'woocommerce' );?></a>
					</p>
				</div>
			</footer>

			<?php //$title_reply = __( 'Add a review', 'woocommerce' ); ?>


			<?php //$title_reply = __( 'Be the first to review', 'woocommerce' ).' &ldquo;'.$post->post_title.'&rdquo;'; ?>

		
		
		<?php $commenter = wp_get_current_commenter(); ?>

	</div>
	<div id="review_form_wrapper">
		<div id="review_form">

			<?php $comment_form = array(
				'title_reply' => 'Write a review',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'fields' => array(
					'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . ' ' . '<span class="required">*</span></label> ' .
					            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
					'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . ' ' . '<span class="required">*</span></label>' .
					            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
				),
				'label_submit' => __( 'Submit Review', 'woocommerce' ),
				'logged_in_as' => '',
				'comment_field' => ''
			);

			if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

				$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'woocommerce' ) .'</label><select name="rating" id="rating">
					<option value="">'.__( 'Rate&hellip;', 'woocommerce' ).'</option>
					<option value="5">'.__( 'Perfect', 'woocommerce' ).'</option>
					<option value="4">'.__( 'Good', 'woocommerce' ).'</option>
					<option value="3">'.__( 'Average', 'woocommerce' ).'</option>
					<option value="2">'.__( 'Not that bad', 'woocommerce' ).'</option>
					<option value="1">'.__( 'Very Poor', 'woocommerce' ).'</option>
				</select></p>';

			}

			$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);

			comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
			?>
		</div>
	</div>
</div>
<?php endif; ?>
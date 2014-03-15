<?php if (!defined('ABSPATH')) die('No direct access allowed!');
/**
* @package Jobs +
* @author Arnold Bailey
* @since version 1.0
* @license GPL2+
*/

global $post, $Jobs_Plus_Core;

$Jobs_Plus_Core->no_comments();

$post_id = (int) empty($_POST['post_id']) ? $post->ID : $_POST['post_id'];
$post = get_post($post_id);

$user = wp_get_current_user();

?>

<?php echo do_action('jbp_error'); ?>
<?php echo do_action('jbp_notice'); ?>

<div id="post-jbp-job">

	<h3><?php _e('Contact ', JBP_TEXT_DOMAIN); the_title()?></h3>

	<form action="#" method="post" id="jbp-job-contact">
		<input type="hidden" name="post_id" value="<?php esc_attr_e( $post_id ); ?>" />
		<input type="hidden" name="username" value="<?php esc_attr_e( $user->user_login ); ?>" />
		<input type="hidden" name="title" value="<?php esc_attr_e( $post->post_title ); ?>" />

		<div class="editfield">
			<label><?php _e('Your name: ', JBP_TEXT_DOMAIN); ?></label>
			<input type="text" name="name" value="" class="required"/>
		</div>

		<div class="editfield">
			<label><?php _e('Your email: ', JBP_TEXT_DOMAIN); ?></label>
			<input type="text" name="email" value="" class="required email" />
		</div>

		<div class="editfield">
			<label><?php _e('Content: ', JBP_TEXT_DOMAIN); ?></label>
			<textarea name="content" rows="5" class="required"><?php esc_textarea($_POST['content']);?></textarea>
		</div>

		<?php wp_nonce_field( 'verify' ); ?>
		<button class="jbp-button" type="submit" name="jbp-job-contact" value="1"><?php _e( 'Submit', JBP_TEXT_DOMAIN ); ?></button>
		<button class="jbp-button" type="button" onclick="location.href='<?php echo get_permalink(get_the_ID()); ?>'"><?php _e( 'Cancel', JBP_TEXT_DOMAIN ); ?></button>
		<script type="text/javascript">jQuery('#jbp-job-contact').validate();</script>
	</form>
</div>

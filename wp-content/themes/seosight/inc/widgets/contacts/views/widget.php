<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}


/**
 * @var array  $args
 * @var string $title
 * @var string $text
 * @var array  $contacts
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

global $allowedtags;
seosight_render( $before_widget );

if ( $title ) {
	seosight_render( $before_title . esc_html( $title ) . $after_title );
}

if ( ! empty( $text ) ) {
	echo '<p class="contacts-text">' . wp_kses( $text, $allowedtags ) . '</p>';
}
if ( ! empty( $contacts ) ) {
	foreach ( $contacts as $contact ) {
		echo '<div class="contacts-item">';
		if ( isset( $contact['icon'] ) && ! empty( $contact['icon'] ) ) {
			echo '<img src="' . fw_resize( $contact['icon'], 96, 96, false ) . '" class="contacts-icon icon" alt="icon"/>';
		}
		echo '<div class="content">';
		if ( isset( $contact['value'] ) && ! empty( $contact['value'] ) ) {
			if ( seosight_is_email( $contact['value'] ) ) {
				echo '<a href="mailto:' . esc_html( $contact['value'] ) . '" class="h5 title">' . esc_html( $contact['value'] ) . '</a>';
			} elseif ( seosight_is_phone( $contact['value'] ) ) {
				echo '<a href="tel:' . esc_html( $contact['value'] ) . '" class="h5 title">' . esc_html( $contact['value'] ) . '</a>';
			} else {
				echo '<span class="h5 title">' . wp_kses( $contact['value'], $allowedtags ) . '</span>';
			}
		}

		if ( isset( $contact['desc'] ) && ! empty( $contact['desc'] ) ) {
			echo '<div class="sub-title">' . wp_kses( $contact['desc'], $allowedtags ) . '</div>';
		}
		echo '</div></div>';
	}
}

seosight_render( $after_widget );
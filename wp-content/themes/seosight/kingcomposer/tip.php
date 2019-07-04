<?php

$text    = '';
extract( $atts );

echo '<span class="tippy" title="' . esc_attr( $text ) . '">' . $content . '</span>';


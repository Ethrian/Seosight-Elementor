<?php
/** @var array $atts */
$type    = $wrap_class = $current_class = $pointdate = '';
$options = array();
wp_enqueue_script( 'seosight-timeline' );
extract( $atts );

//Kingcomposer wrapper class for each element
$wrap_class = apply_filters( 'kc-el-class', $atts );
//custom class element
$wrap_class[] = 'theme-module';
$i       = 0;
?>
<div class="<?php echo implode( ' ', $wrap_class ); ?>">
    <?php if ( ! empty( $options ) ) {
        ?>
        <section class="cd-horizontal-timeline">
            <?php ob_start(); ?>
            <div class="timeline">
                <div class="events-wrapper">
					<div class="events">
                        <ol>
                            <?php
                            $i = 0;
                            foreach ( $options as $option ) {
                                $datetime     = $option->pointdate;
                                $datetime = str_replace('/','-',$datetime);
                                $date         = ( ! empty( $datetime ) && $datetime !== '__empty__' ) ? $datetime : date( "D M d Y", strtotime( "+1 week" ) );
                                $data_date    = date( 'd/m/Y', strtotime( $date ) );
                                $year         = date( 'Y', strtotime( $date ) );
                                $curent_class = $i == 0 ? 'selected' : '';
                                ?>
                                <li>
                                    <a href="#0" data-date="<?php echo esc_attr( $data_date ) ?>"
                                       class="<?php echo esc_attr( $curent_class ) ?>"><?php echo esc_html( $year ) ?></a>
                                </li>
                                <?php
                                $i ++;
                            } ?>
                            <!-- other dates here -->
                        </ol>
                        <span class="filling-line" aria-hidden="true"></span>
                    </div> <!-- .events -->
                </div> <!-- .events-wrapper -->

                <ul class="cd-timeline-navigation">
                    <li><a href="#0" class="prev inactive seoicon-play"><?php esc_html_e( 'Prev', 'seosight' ) ?></a>
                    </li>
                    <li><a href="#0" class="next seoicon-play"><?php esc_html_e( 'Next', 'seosight' ) ?></a></li>
                </ul> <!-- .cd-timeline-navigation -->
            </div> <!-- .timeline -->
            <?php
            $timeline = ob_get_clean();
            if ( 'bottom' !== $type ) {
                seosight_render( $timeline );
            }
            ?>
            <div class="events-content">
                <ol>
                    <?php
                    $i = 0;
                    foreach ( $options as $option ) {
                        $datetime     = $option->pointdate;
                        $datetime = str_replace('/','-',$datetime);
                        $date         = ( ! empty( $datetime ) && $datetime !== '__empty__' ) ? $datetime : date( "D M d Y", strtotime( "+1 week" ) );
                        $data_date    = date( 'd/m/Y', strtotime( $date ) );
                        $year         = date( 'M, Y', strtotime( $date ) );
                        $curent_class = $i == 0 ? 'selected' : '';
                        ?>
                        <li class="<?php echo esc_attr( $curent_class ) ?>"
                            data-date="<?php echo esc_attr( $data_date ) ?>">
                            <div class="row">
                                <?php
                                if ( ! empty( $option->image ) ) {
                                    $content_class = 'col-lg-8 col-lg-offset-1 col-md-8 col-md-offset-1 col-sm-9 col-xs-12 table-cell';
                                    $image         = wp_get_attachment_image_src( $option->image, 'full' );
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 table-cell">
                                        <div class="time-line-thumb">
                                            <img src="<?php echo esc_url($image[0]) ?>" alt="thumb">
                                        </div>
                                    </div>
                                <?php } else {
                                    $content_class = 'col-sm-12';
                                }
                                ?>
                                <div class="<?php echo esc_attr( $content_class ) ?>">
                                    <div class="time-line-content">
                                        <h6 class="time-line-subtitle"><?php echo esc_html( $year ) ?></h6>
                                        <h5 class="time-line-title"><?php echo esc_html( $option->title ) ?></h5>
                                        <div class="time-line-text"><?php echo wpautop( $option->desc ) ?></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                        $i ++;
                    } ?>
                    <!-- other descriptions here -->
                </ol>
            </div> <!-- .events-content -->
            <?php if ( 'bottom' === $type ) {
                seosight_render( $timeline );
            } ?>
        </section>
    <?php } else { ?>
        <?php esc_html_e( 'Please create any timeline points', 'seosight' ); ?>
    <?php } ?>
</div>
<?php kc_js_callback( 'CRUMINA.runTimeLine' ); ?>
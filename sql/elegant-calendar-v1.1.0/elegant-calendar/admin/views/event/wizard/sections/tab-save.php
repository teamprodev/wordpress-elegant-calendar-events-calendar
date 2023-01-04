<?php
$status = isset( $settings['status'] ) ? sanitize_text_field( $settings['status'] ) : 'draft';
?>
<div id="elegant-builder-status" class="elegant-box elegant-box-sticky">
    <div class="elegant-box-status">
        <div class="elegant-status">
            <div class="elegant-status-module">
                <?php esc_html_e( 'Status', Elegant_Calendar::DOMAIN ); ?>
                    <?php
                    if( $status === 'draft'){
                        ?>
                    <span class="elegant-tag elegant-tag-draft">
                        <?php esc_html_e( 'draft', Elegant_Calendar::DOMAIN ); ?>
                    </span>
                    <?php
                    }else if($status === 'publish'){
                        ?>
                    <span class="elegant-tag elegant-tag-published">
                       <?php esc_html_e( 'published', Elegant_Calendar::DOMAIN ); ?>
                    </span>
                    <?php
                    }
                    ?>
            </div>
            <div class="elegant-status-changes">

            </div>
        </div>
        <div class="elegant-actions">
            <button id="elegant-event-draft" class="elegant-button" type="button">
                <span class="elegant-loading-text">
                    <ion-icon name="reload-circle"></ion-icon>
                    <span class="button-text event-save-text">
                        <?php
                        if($status === 'publish'){
                            echo esc_html( 'unpublish', Elegant_Calendar::DOMAIN );
                        }else{
                            echo esc_html( 'save draft', Elegant_Calendar::DOMAIN );
                        }
                        ?>
                    </span>
                </span>
            </button>
            <button id="elegant-event-publish" class="elegant-button elegant-button-blue" type="button">
                <span class="elegant-loading-text">
                    <ion-icon name="save"></ion-icon>
                    <span class="button-text event-publish-text">
                        <?php
                        if($status === 'publish'){
                            echo esc_html( 'update', Elegant_Calendar::DOMAIN );
                        }else{
                            echo esc_html( 'publish', Elegant_Calendar::DOMAIN );
                        }
                        ?>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>

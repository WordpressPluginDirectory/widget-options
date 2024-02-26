<?php

/**
 * Settings Widget Options
 *
 * @copyright   Copyright (c) 2015, Jeffrey Carandang
 * @since       1.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Add Settings Widget Options Tab
 *
 * @since 1.0
 * @return void
 */

/**
 * Called on 'extended_widget_opts_tabs'
 * create new tab navigation for alignment options
 */
function widgetopts_tab_behavior($args)
{ ?>
    <li class="extended-widget-opts-tab-behavior">
        <a href="#extended-widget-opts-tab-<?php echo $args['id']; ?>-behavior" title="<?php _e('Misc & Class,ID', 'widget-options'); ?>"><span class="dashicons dashicons-admin-generic"></span> <span class="tabtitle"><?php _e('Behavior', 'widget-options'); ?></span></a>
    </li>
    <?php
}
add_action('extended_widget_opts_tabs', 'widgetopts_tab_behavior', 7);

/**
 * Called on 'extended_widget_opts_tabcontent'
 * create new tab content options for alignment options
 */
if (!function_exists('widgetopts_tabcontent_behavior')) :
    function widgetopts_tabcontent_behavior($args)
    {
        global $widget_options;

        $id         = '';
        $classes    = '';
        $logic      = '';
        $selected   = 0;
        $check      = '';
        if (isset($args['params']) && isset($args['params']['class'])) {
            if (isset($args['params']['class']['id'])) {
                $id = $args['params']['class']['id'];
            }
            if (isset($args['params']['class']['classes'])) {
                $classes = $args['params']['class']['classes'];
            }
            if (isset($args['params']['class']['selected'])) {
                $selected = $args['params']['class']['selected'];
            }
            if (isset($args['params']['class']['logic'])) {
                $logic = $args['params']['class']['logic'];
            }
            if (isset($args['params']['class']['title']) && $args['params']['class']['title'] == '1') {
                $check = 'checked="checked"';
            }
        }

        $predefined = array();
        if (isset($widget_options['settings']['classes']) && isset($widget_options['settings']['classes']['classlists']) && !empty($widget_options['settings']['classes']['classlists'])) {
            $predefined = $widget_options['settings']['classes']['classlists'];
        }
    ?>
        <div id="extended-widget-opts-tab-<?php echo $args['id']; ?>-behavior" class="extended-widget-opts-tabcontent extended-widget-opts-inside-tabcontent extended-widget-opts-tabcontent-class">

            <div class="extended-widget-opts-settings-tabs extended-widget-opts-inside-tabs">
                <input type="hidden" id="extended-widget-opts-settings-selectedtab" value="<?php echo $selected; ?>" name="<?php echo $args['namespace']; ?>[extended_widget_opts][class][selected]" />
                <!--  start tab nav -->
                <ul style="margin-top: 10px;" class="extended-widget-opts-settings-tabnav-ul">
                    <?php if ('activate' == $widget_options['hide_title']) { ?>
                        <li class="extended-widget-opts-settings-tab-title">
                            <a href="#extended-widget-opts-settings-tab-<?php echo $args['id']; ?>-title" title="<?php _e('Misc', 'widget-options'); ?>"><?php _e('Misc', 'widget-options'); ?></a>
                        </li>
                    <?php } ?>

                    <?php if ('activate' == $widget_options['classes']) { ?>
                        <li class="extended-widget-opts-settings-tab-class">
                            <a href="#extended-widget-opts-settings-tab-<?php echo $args['id']; ?>-class" title="<?php _e('Class & ID', 'widget-options'); ?>"><?php _e('Class & ID', 'widget-options'); ?></a>
                        </li>
                    <?php } ?>
                    <div class="extended-widget-opts-clearfix"></div>
                </ul><!--  end tab nav -->
                <div class="extended-widget-opts-clearfix"></div>

                <?php if ('activate' == $widget_options['hide_title']) { ?>
                    <!--  start title tab content -->
                    <div id="extended-widget-opts-settings-tab-<?php echo $args['id']; ?>-title" class="extended-widget-opts-settings-tabcontent extended-widget-opts-inner-tabcontent">
                        <div class="widget-opts-title">
                            <?php if ('activate' == $widget_options['hide_title']) { ?>
                                <p class="widgetopts-subtitle"><?php _e('Hide Widget Title', 'widget-options'); ?></p>
                                <p>
                                    <input type="checkbox" name="<?php echo $args['namespace']; ?>[extended_widget_opts][class][title]" id="opts-class-title-<?php echo $args['id']; ?>" value="1" <?php echo $check; ?> />
                                    <label for="opts-class-title-<?php echo $args['id']; ?>"><?php _e('Check to hide widget title', 'widget-options'); ?></label>
                                </p>
                            <?php } ?>
                        </div>
                    </div><!--  end title tab content -->
                <?php } ?>

                <?php if ('activate' == $widget_options['classes']) { ?>
                    <!--  start class tab content -->
                    <div id="extended-widget-opts-settings-tab-<?php echo $args['id']; ?>-class" class="extended-widget-opts-settings-tabcontent extended-widget-opts-inner-tabcontent">
                        <div class="widget-opts-class">
                            <table class="form-table">
                                <tbody>
                                    <?php if (isset($widget_options['settings']['classes']) && (isset($widget_options['settings']['classes']['id']) && '1' == $widget_options['settings']['classes']['id'])) { ?>
                                        <tr valign="top" class="widgetopts_id_fld">
                                            <td scope="row">
                                                <strong><?php _e('Widget CSS ID:', 'widget-options'); ?></strong><br />
                                                <input type="text" id="opts-class-id-<?php echo $args['id']; ?>" class="widefat" name="<?php echo $args['namespace']; ?>[extended_widget_opts][class][id]" value="<?php echo $id; ?>" />
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    <?php if (
                                        !isset($widget_options['settings']['classes']) ||
                                        (isset($widget_options['settings']['classes']) && isset($widget_options['settings']['classes']['type']) && !in_array($widget_options['settings']['classes']['type'], array('hide', 'predefined')))
                                    ) { ?>
                                        <tr valign="top">
                                            <td scope="row">
                                                <strong><?php _e('Widget CSS Classes:', 'widget-options'); ?></strong><br />
                                                <input type="text" id="opts-class-classes-<?php echo $args['id']; ?>" class="widefat" name="<?php echo $args['namespace']; ?>[extended_widget_opts][class][classes]" value="<?php echo $classes; ?>" />
                                                <small><em><?php _e('Separate each class with space.', 'widget-options'); ?></em></small>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if (
                                        !isset($widget_options['settings']['classes']) ||
                                        (isset($widget_options['settings']['classes']) && isset($widget_options['settings']['classes']['type']) && !in_array($widget_options['settings']['classes']['type'], array('hide', 'text')))
                                    ) { ?>
                                        <?php if (is_array($predefined) && !empty($predefined)) {
                                            $predefined = array_unique($predefined); //remove dups
                                        ?>
                                            <tr valign="top">
                                                <td scope="row">
                                                    <strong><?php _e('Available Widget Classes:', 'widget-options'); ?></strong><br />
                                                    <div class="extended-widget-opts-class-lists" style="max-height: 230px;padding: 5px;overflow:auto;">
                                                        <?php foreach ($predefined as $key => $value) {
                                                            if (
                                                                isset($args['params']['class']['predefined']) &&
                                                                is_array($args['params']['class']['predefined']) &&
                                                                in_array($value, $args['params']['class']['predefined'])
                                                            ) {
                                                                $checked = 'checked="checked"';
                                                            } else {
                                                                $checked = '';
                                                            }
                                                        ?>
                                                            <p>
                                                                <input type="checkbox" name="<?php echo $args['namespace']; ?>[extended_widget_opts][class][predefined][]" id="<?php echo $args['id']; ?>-opts-class-<?php echo $key; ?>" value="<?php echo $value; ?>" <?php echo $checked; ?> />
                                                                <label for="<?php echo $args['id']; ?>-opts-class-<?php echo $key; ?>"><?php echo $value; ?></label>
                                                            </p>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!--  end class tab content -->
                <?php } ?>

            </div><!-- end .extended-widget-opts-settings-tabs -->


        </div>
<?php
    }
    add_action('extended_widget_opts_tabcontent', 'widgetopts_tabcontent_behavior');
endif; ?>
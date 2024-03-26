<?php

class acf_field_chosen_select extends acf_field
{

    // vars
    var $settings, // will hold info such as dir / path
        $defaults; // will hold default field options


    /*
    *  __construct
    *
    *  Set name / label needed for actions / filters
    *
    *  @since	3.6
    *  @date	23/01/13
    */

    function __construct()
    {
        // vars
        $this->name = 'chosen_select';
        $this->label = __('Chosen select');
        $this->category = __("Choice", 'acf'); // Basic, Content, Choice, etc
        $this->defaults = array(
            'multiple' => 0,
            'allow_null' => 0,
            'choices' => array(),
            'default_value' => ''
        );


        // do not delete!
        parent::__construct();


        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '1.0.0'
        );

    }


    /*
    *  create_options()
    *
    *  Create extra options for your field. This is rendered when editing a field.
    *  The value of $field['name'] can be used (like below) to save extra data to the $field
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field	- an array holding all the field's data
    */

    function create_options($field)
    {
        $key = $field['name'];


        // implode choices so they work in a textarea
        if (is_array($field['choices'])) {
            foreach ($field['choices'] as $k => $v) {
                $field['choices'][$k] = $k . ' : ' . $v;
            }
            $field['choices'] = implode("\n", $field['choices']);
        }

        ?>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label for=""><?php _e("Choices", 'acf'); ?></label>

                <p><?php _e("Enter each choice on a new line.", 'acf'); ?></p>

                <p><?php _e("For more control, you may specify both a value and label like this:", 'acf'); ?></p>

                <p><?php _e("red : Red", 'acf'); ?><br/><?php _e("blue : Blue", 'acf'); ?></p>
            </td>
            <td>
                <?php

                do_action('acf/create_field', array(
                    'type' => 'textarea',
                    'class' => 'textarea field_option-choices',
                    'name' => 'fields[' . $key . '][choices]',
                    'value' => $field['choices'],
                ));

                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Default Value", 'acf'); ?></label>

                <p class="description"><?php _e("Enter each default value on a new line", 'acf'); ?></p>
            </td>
            <td>
                <?php

                do_action('acf/create_field', array(
                    'type' => 'textarea',
                    'name' => 'fields[' . $key . '][default_value]',
                    'value' => $field['default_value'],
                ));

                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Allow Null?", 'acf'); ?></label>
            </td>
            <td>
                <?php
                do_action('acf/create_field', array(
                    'type' => 'radio',
                    'name' => 'fields[' . $key . '][allow_null]',
                    'value' => $field['allow_null'],
                    'choices' => array(
                        1 => __("Yes", 'acf'),
                        0 => __("No", 'acf'),
                    ),
                    'layout' => 'horizontal',
                ));
                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Select multiple values?", 'acf'); ?></label>
            </td>
            <td>
                <?php
                do_action('acf/create_field', array(
                    'type' => 'radio',
                    'name' => 'fields[' . $key . '][multiple]',
                    'value' => $field['multiple'],
                    'choices' => array(
                        1 => __("Yes", 'acf'),
                        0 => __("No", 'acf'),
                    ),
                    'layout' => 'horizontal',
                ));
                ?>
            </td>
        </tr>
    <?php

    }


    /*
    *  create_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param	$field - an array holding all the field's data
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    function create_field($field)
    {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */

        // perhaps use $field['preview_size'] to alter the markup?


        // create Field HTML


        // vars
        $optgroup = false;


        // determin if choices are grouped (2 levels of array)
        if (is_array($field['choices'])) {
            foreach ($field['choices'] as $k => $v) {
                if (is_array($v)) {
                    $optgroup = true;
                }
            }
        }


        // value must be array
        if (!is_array($field['value'])) {
            // perhaps this is a default value with new lines in it?
            if (strpos($field['value'], "\n") !== false) {
                // found multiple lines, explode it
                $field['value'] = explode("\n", $field['value']);
            } else {
                $field['value'] = array($field['value']);
            }
        }


        // trim value
        $field['value'] = array_map('trim', $field['value']);


        // multiple select
        $multiple = '';
        if ($field['multiple']) {
            // create a hidden field to allow for no selections
            echo '<input type="hidden" name="' . $field['name'] . '" />';

            $multiple = ' multiple="multiple" size="5" ';
            $field['name'] .= '[]';
        }


        // html
        echo '<select id="' . $field['id'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '" ' . $multiple . ' >';


        // null
        if ($field['allow_null']) {
            echo '<option value="null">- ' . __("Select", 'acf') . ' -</option>';
        }

        // loop through values and add them as options
        if (is_array($field['choices'])) {
            foreach ($field['choices'] as $key => $value) {
                if ($optgroup) {
                    // this select is grouped with optgroup
                    if ($key != '') echo '<optgroup label="' . $key . '">';

                    if (is_array($value)) {
                        foreach ($value as $id => $label) {
                            $selected = in_array($id, $field['value']) ? 'selected="selected"' : '';

                            echo '<option value="' . $id . '" ' . $selected . '>' . $label . '</option>';
                        }
                    }

                    if ($key != '') echo '</optgroup>';
                } else {
                    $selected = in_array($key, $field['value']) ? 'selected="selected"' : '';
                    echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
                }
            }
        }

        echo '</select>';

        ?>
        <div>
            <?php print_r($_SERVER); ?>
            <select data-placeholder="Your Favorite Type of Bear" style="width:350px;" class="chosen-select-deselect"
                    tabindex="12">
                <option value=""></option>
                <option>American Black Bear</option>
                <option>Asiatic Black Bear</option>
                <option>Brown Bear</option>
                <option>Giant Panda</option>
                <option selected>Sloth Bear</option>
                <option>Sun Bear</option>
                <option>Polar Bear</option>
                <option>Spectacled Bear</option>
            </select>
        </div>
        <script>
            jQuery(document).ready(function ($) {
                $(".<?php echo $field['class']; ?>").chosen({
                    allow_single_deselect: true
                });
            })
        </script>
    <?php
    }


    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add CSS + JavaScript to assist your create_field() action.
    *
    *  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    function input_admin_enqueue_scripts()
    {
        // Note: This function can be removed if not used


        // register ACF scripts
        wp_register_script('acf-chosen-jquery-js', $this->settings['dir'] . 'js/chosen.jquery.min.js', array('acf-input'), $this->settings['version']);
        wp_register_script('acf-chosen-proto-js', $this->settings['dir'] . 'js/chosen.proto.min.js', array('acf-input'), $this->settings['version']);
        wp_register_style('acf-chosen-css', $this->settings['dir'] . 'css/chosen.min.css', array('acf-input'), $this->settings['version']);


        // scripts
        wp_enqueue_script(array(
            'acf-chosen-jquery-js',
        ));

        wp_enqueue_script(array(
            'acf-chosen-proto-js',
        ));


        // styles
        wp_enqueue_style(array(
            'acf-chosen-css',
        ));


    }


    /*
    *  input_admin_head()
    *
    *  This action is called in the admin_head action on the edit screen where your field is created.
    *  Use this action to add CSS and JavaScript to assist your create_field() action.
    *
    *  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    function input_admin_head()
    {
        // Note: This function can be removed if not used
    }


    /*
    *  field_group_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
    *  Use this action to add CSS + JavaScript to assist your create_field_options() action.
    *
    *  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    function field_group_admin_enqueue_scripts()
    {
        // Note: This function can be removed if not used
    }


    /*
    *  field_group_admin_head()
    *
    *  This action is called in the admin_head action on the edit screen where your field is edited.
    *  Use this action to add CSS and JavaScript to assist your create_field_options() action.
    *
    *  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    function field_group_admin_head()
    {
        // Note: This function can be removed if not used
    }


    /*
    *  load_value()
    *
        *  This filter is applied to the $value after it is loaded from the db
    *
    *  @type	filter
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$value - the value found in the database
    *  @param	$post_id - the $post_id from which the value was loaded
    *  @param	$field - the field array holding all the field options
    *
    *  @return	$value - the value to be saved in the database
    */

    function load_value($value, $post_id, $field)
    {
        // Note: This function can be removed if not used
        return $value;
    }


    /*
    *  update_value()
    *
    *  This filter is applied to the $value before it is updated in the db
    *
    *  @type	filter
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$value - the value which will be saved in the database
    *  @param	$post_id - the $post_id of which the value will be saved
    *  @param	$field - the field array holding all the field options
    *
    *  @return	$value - the modified value
    */

    function update_value($value, $post_id, $field)
    {
        // Note: This function can be removed if not used
        return $value;
    }


    /*
    *  format_value()
    *
    *  This filter is applied to the $value after it is loaded from the db and before it is passed to the create_field action
    *
    *  @type	filter
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$value	- the value which was loaded from the database
    *  @param	$post_id - the $post_id from which the value was loaded
    *  @param	$field	- the field array holding all the field options
    *
    *  @return	$value	- the modified value
    */

    function format_value($value, $post_id, $field)
    {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */

        // perhaps use $field['preview_size'] to alter the $value?


        // Note: This function can be removed if not used
        return $value;
    }


    /*
    *  format_value_for_api()
    *
    *  This filter is applied to the $value after it is loaded from the db and before it is passed back to the API functions such as the_field
    *
    *  @type	filter
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$value	- the value which was loaded from the database
    *  @param	$post_id - the $post_id from which the value was loaded
    *  @param	$field	- the field array holding all the field options
    *
    *  @return	$value	- the modified value
    */

    function format_value_for_api($value, $post_id, $field)
    {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */

        // perhaps use $field['preview_size'] to alter the $value?


        // Note: This function can be removed if not used
        return $value;
    }


    /*
    *  load_field()
    *
    *  This filter is applied to the $field after it is loaded from the database
    *
    *  @type	filter
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field - the field array holding all the field options
    *
    *  @return	$field - the field array holding all the field options
    */

    function load_field($field)
    {
        // Note: This function can be removed if not used
        return $field;
    }


    /*
    *  update_field()
    *
    *  This filter is applied to the $field before it is saved to the database
    *
    *  @type	filter
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field - the field array holding all the field options
    *  @param	$post_id - the field group ID (post_type = acf)
    *
    *  @return	$field - the modified field
    */

    function update_field($field, $post_id)
    {
        // Note: This function can be removed if not used
        return $field;
    }


}


// create field
new acf_field_chosen_select();

?>

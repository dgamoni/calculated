<?php
// Creating the widget 
class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_widget', 

// Widget name will appear in UI
__('Calculated Widget', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Calculated', 'wpb_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
// echo $args['before_widget'];
// if ( ! empty( $title ) )
// echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
//echo __( 'Hello, World!', 'wpb_widget_domain' );
$_SESSION['subtotal'] = $subtotal;
echo '
<form name="qwe" method="get" action="'. plugins_url( 'result1.php' , __FILE__ ) .'">
<table class="tg" style="undefined;table-layout: fixed; width: 100%">
<colgroup>
<col style="width: 50%">
<col style="width: 50%">
</colgroup>
  <tr>
    <th class="tg-031e" colspan="2"><h2>'. $title .'</h2></th>
  </tr>
  <tr>
    <td class="tg-ugh9"><h2>Разрешение камер</h2></td>
    <td class="tg-2c7p"><h2>Заказчик</h2></td>
  </tr>
  <tr>
    <td class="tg-031e">
    			<select name="camera" id="camera">
				    <option value="0">стандартное</option>
				    <option value="1">высокое</option>
				</select>
	</td>
    <td class="tg-s6z2">
    			<select name="nds" id="nds">
				    <option value="0">физ.лицо</option>
				    <option value="1">организация</option>
				</select>
    </td>
  </tr>
  <tr>
    <td class="tg-ugh9" colspan="2"><h2>Монтаж системы</h2></td>
  </tr>
  <tr>
  	
    <td class="tg-031e"><input id="montag1" name="montag" type="radio" value="0" checked/>не требуется</td>
    <td class="tg-s6z2"></td>
  </tr>
  <tr>
    <td class="tg-ugh9"><input id="montag2" name="montag" type="radio" value="1" />простой</td>
    <td class="tg-2c7p"></td>
  </tr>
  <tr>
    <td class="tg-031e"><input id="montag3"  name="montag" type="radio" value="2" />сложный</td>
    <td class="tg-s6z2"></td>
    
  </tr>
  <tr>
    <td class="tg-ugh9" colspan="2"><h2>Количество камер</h2></td>
  </tr>
  <tr>
    <td class="tg-031e">внешних</td>
    <td class="tg-s6z2"><input class="w50" id="sum_camera_1" min="0" name="" type="number" value="0" /></td>
  </tr>
    <tr>
    <td class="tg-031e">внутрених</td>
    <td class="tg-s6z2"><input class="w50" id="sum_camera_2" min="0" name="" type="number" value="0" /></td>
  </tr>
  <tr>
    <td class="tg-031e"><h2>Стоимость:</h2></td>
    <td class="tg-s6z2"><input id="total6" class="w50" readonly id="total6" type="text" name="subtotal" value="0"/>руб</td>
  </tr>
  <tr>
    <td class="tg-ugh9"></td>
    <td class="tg-2c7p"><a href="#test-popup" class="open-popup-link" id="result" >подробнее</a></td>
  </tr>
</table>
';



// session_start();
// $_SESSION['title'] = $title;
// echo '
// <form method="get" action="'. plugins_url( 'result1.php' , __FILE__ ) .'">
//     <input type="text" name="title" value="">
//     <input type="submit">
// </form>';



$reg4 = get_field('calx_reg4', 'option') ? get_field('calx_reg4', 'option') : 3600;
$reg8 = get_field('calx_reg8', 'option') ? get_field('calx_reg8', 'option') : 10000;
$reg12 = get_field('calx_reg12', 'option') ? get_field('calx_reg12', 'option') : 12810;
//$_SESSION['reg4'] = $reg4;

$out_camera = get_field('calx_out_camera', 'option') ? get_field('calx_out_camera', 'option') : 5070;
$out_camera_full = get_field('calx_out_camera_full', 'option') ? get_field('calx_out_camera_full', 'option') : 7605;

$in_camera = get_field('calx_in_camera', 'option') ? get_field('calx_in_camera', 'option') : 4670;
$in_camera_full = get_field('calx_in_camera_full', 'option') ? get_field('calx_in_camera_full', 'option') : 7005;

$hdd = get_field('calx_hdd', 'option') ? get_field('calx_hdd', 'option') : 1800;
$montag_set = get_field('calx_montag_set', 'option') ? get_field('calx_montag_set', 'option') : 3200;
$bp = get_field('calx_bp', 'option') ? get_field('calx_bp', 'option') : 2650;

$montag_work_1 = get_field('calx_montag_work_1', 'option') ? get_field('calx_montag_work_1', 'option') : 4158;
$montag_work_2 = get_field('calx_montag_work_2', 'option') ? get_field('calx_montag_work_2', 'option') : 6237;

echo '<script>
var
  reg4 = '.$reg4.';
  reg8 = '.$reg8.';
  reg12 = '.$reg12.';

  out_camera = '.$out_camera.';
  out_camera_full = '.$out_camera_full.';

  in_camera = '.$in_camera.';
  in_camera_full = '.$in_camera_full.';

  hdd = '.$hdd.';
  montag_set = '.$montag_set.';
  bp = '.$bp.';

  montag_work_1 = '.$montag_work_1.';
  montag_work_2 = '.$montag_work_2.';

</script>';

$calx_logo = get_field('calx_logo', 'option') ? get_field('calx_logo', 'option') : '';
$calx_adress = get_field('calx_adress', 'option') ? get_field('calx_adress', 'option') : '';
$calx_title = get_field('calx_title', 'option') ? get_field('calx_title', 'option') : '';
$calx_description = get_field('calx_description', 'option') ? get_field('calx_description', 'option') : '';
$calx_time = get_field('calx_time', 'option') ? get_field('calx_time', 'option') : '';
$calx_footer = get_field('calx_footer', 'option') ? get_field('calx_footer', 'option') : '';


echo '
<div id="test-popup" class="white-popup mfp-hide">

 <div style="width: 370px;float: left;margin-bottom: 20px;"><a class="logo" href="/" style="padding-top:43px"><img src="'.$calx_logo['url'].'"></a></div>
 <div>'.$calx_adress.'</div>
 <div style="clear: both;"></div>
  <p style="font-size: 21px;">'.$calx_title.'</p>
  <p style="margin-bottom: 10px;">'.$calx_description.'</p>


<table id="mono-calx" cellspacing="0" style="width: 100%;border: 1px solid #D5D5D5;">

<tbody><tr>
  <td><h4>Наименование</h4></td>
  <td><h4>Количество</h4></td>
  <td><h4>Цена за ед.</h4></td>
  <td><h4>Цена</h4></td>
</tr>

<tr >
  <td>Регистратор 4 канальный</td>
  <td id="td_tip_reg4_col" align="right"></td>
  <td id="td_tip_reg4_e" id="r4_e" align="right"></td>
  <td id="td_tip_reg4_sum" align="right"></td>
</tr>
<tr >
  <td>Регистратор 8 канальный</td>
  <td  id="td_tip_reg8_col" align="right"></td>
  <td  id="td_tip_reg8_e" align="right"></td>
  <td  id="td_tip_reg8_sum" align="right"></td>
</tr>
<tr >
  <td>Регистратор 16 канальный</td>
  <td  id="td_tip_reg12_col" align="right"></td>
  <td  id="td_tip_reg12_e" align="right"></td>
  <td  id="td_tip_reg12_sum" align="right"></td>
</tr>

<tr>
  <td>Внешняя видеокамера</td>
  <td id="td_out_camera_col" align="right"></td>
  <td id="td_out_camera_e" align="right"></td>
  <td id="td_out_camera_sum" align="right"></td>
</tr>
<tr>
  <td>Внутриофисная видеокамера</td>
  <td id="td_in_camera_col" align="right"></td>
  <td id="td_in_camera_e" align="right"></td>
  <td id="td_in_camera_sum" align="right"></td>
</tr>
<tr>
  <td>Высококачественная внешняя видеокамера</td>
  <td id="td_out_camera_full_col" align="right"></td>
  <td id="td_out_camera_full_e" align="right"></td>
  <td id="td_out_camera_full_sum" align="right"></td>
</tr>
<tr>
  <td>Высококачественная внутриофисная видеокамера</td>
  <td id="td_in_camera_full_col" align="right"></td>
  <td id="td_in_camera_full_e" align="right"></td>
  <td id="td_in_camera_full_sum" align="right"></td>
</tr>
<tr>
  <td>Жесткий диск</td>
  <td id="td_hdd" align="right"></td>
  <td id="td_hdd_e" align="right"></td>
  <td id="td_hdd_sum" align="right"></td>
</tr>
  <tr><td>Монтажный набор</td>
  <td id="td_motag_set" align="right"></td>
  <td id="td_motag_set_e" align="right"></td>
  <td id="td_motag_set_sum" align="right"></td>
</tr>
<tr>
  <td>Блок питания DC 12в.</td>
  <td id="td_bp_col" align="right"></td>
  <td id="td_bp_e" align="right"></td>
  <td id="td_bp_sum" align="right"></td>
</tr>
<tr>
  <td>Монтажные работы</td>
  <td id="td_sum_all" align="right"></td>
  <td id="td_motag_work_e" align="right"></td>
  <td id="td_motag_work_sum" align="right"></td>
</tr>

<tr>
  <td></td>
  <td align="right"></td>
  <td align="right"><h4>НДС(18%):</td>
  <td id="td_procent" align="right"></td>
</tr>
<tr>
  <td></td>
  <td align="right"></td>
  <td align="right">Итого c НДС:</td>
  <td  id="td_all" align="right"></td>
</tr>

</tbody></table>

<p style="margin-top: 10px;">'.$calx_time.'</p>
<strong>'.$calx_footer.'</strong>

</div>';


echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {





if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
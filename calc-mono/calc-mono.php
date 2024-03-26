<?php
/*
Plugin Name: Calculated 
Plugin URI: http://monothemes.com
Description: 
Version: 1.0.1
Author: Andrey Monin
Author URI: http://monothemes.com
License: GPL
*/


require_once 'ACF/init.php';
require_once 'widgets/uniwidget_menu.php';
//require_once 'export.php';

function my_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_register_style( 'prefix-style', plugins_url('css/custom.css', __FILE__) );
	wp_register_style( 'magnific-popup', plugins_url('js/magnific-popup.css', __FILE__) );
	wp_enqueue_style( 'prefix-style' );
	wp_enqueue_style( 'magnific-popup' );
	wp_enqueue_script('newscript',plugins_url( 'js/jquery.magnific-popup.min.js' , __FILE__ ),array( 'jquery' ));
	//wp_enqueue_script('arithmetics',plugins_url( 'js/jquery.basic_arithmetics.min.js' , __FILE__ ),array( 'jquery' ));
	wp_enqueue_script('custom',plugins_url( 'js/custom.js' , __FILE__ ),array( 'jquery' ));
}
add_action('wp_enqueue_scripts','my_scripts');


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_%d0%b4%d0%b0%d0%bd%d0%bd%d1%8b%d0%b5-%d0%b4%d0%bb%d1%8f-%d1%80%d0%b0%d1%81%d1%87%d0%b5%d1%82%d0%b0',
		'title' => 'Данные для расчета',
		'fields' => array (
			array (
				'key' => 'field_54480dabb8562',
				'label' => 'Регистратор 4 канальный',
				'name' => 'calx_reg4',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 3600,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_54480ea06e648',
				'label' => 'Регистратор 8 канальный',
				'name' => 'calx_reg8',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 10000,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_54480eda6e649',
				'label' => 'Регистратор 16 канальный',
				'name' => 'calx_reg16',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 12810,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_54480f71c43e3',
				'label' => 'Внешняя видеокамера',
				'name' => 'calx_out_camera',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 5070,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_54480febc43e4',
				'label' => 'Внутриофисная видеокамера',
				'name' => 'calx_in_camera',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 4670,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_5448106f2fcf8',
				'label' => 'Высококачественная внешняя видеокамера',
				'name' => 'calx_out_camera_full',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 7605,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_5448109d2fcf9',
				'label' => 'Высококачественная внутриофисная видеокамера',
				'name' => 'calx_in_camera_full',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 7005,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_54481124b218e',
				'label' => 'Жесткий диск ',
				'name' => 'calx_hdd',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 1800,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_54481180b218f',
				'label' => 'Монтажный набор ',
				'name' => 'calx_montag_set',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 3200,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_544811cea1f7b',
				'label' => 'Блок питания DC 12в. ',
				'name' => 'calx_bp',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 2650,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_544811f6a1f7c',
				'label' => 'Монтажные работы простые',
				'name' => 'calx_montag_work_1',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 4158,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_544812baa1f7d',
				'label' => 'Монтажные работы сложные',
				'name' => 'calx_montag_work_2',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 6237,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_%d0%b8%d1%82%d0%be%d0%b3%d0%be%d0%b2%d1%8b%d0%b9-%d0%b1%d0%bb%d0%b0%d0%bd%d0%ba',
		'title' => 'Итоговый бланк',
		'fields' => array (
			array (
				'key' => 'field_5444af2bec3d6',
				'label' => 'Логотип',
				'name' => 'calx_logo',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_54480a8a39648',
				'label' => 'Адрес',
				'name' => 'calx_adress',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => 'Общество с ограниченной ответственностью \'Контур-Т\' Адрес: ул. Миклухо-Маклая д.42 Б 117342 Москва,	Телефон:+7 (495) 429-60-10, Факс:+7 (495) 429-60-10,	Электронная почта: konturt@kontur-gr.ru',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_54480ad439649',
				'label' => 'Название',
				'name' => 'calx_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Коммерческое предложение',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54480b0e3964a',
				'label' => 'Описание',
				'name' => 'calx_description',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'по системе видеонаблюдения',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54480c2c595db',
				'label' => 'Время выпонения',
				'name' => 'calx_time',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Время выпонения 1-3 дня',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54480c5b595dc',
				'label' => 'Подпись',
				'name' => 'calx_footer',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Генеральный директор ООО "Контур-Т"																				________/ Емельянов А.А. /',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



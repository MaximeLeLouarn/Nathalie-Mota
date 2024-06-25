<?php

function nathaliephotos_add_admin_pages() {
    add_menu_page(__('Paramètres du thème Nathalie Mota', 'nathaliephotos'), __('NathaliePhotos', 'nathaliephotos'), 'manage_options', 'nathaliephotos-settings', 'nathaliephotos_theme_settings', 'dashicons-admin-settings', 60);
}

function nathaliephotos_theme_settings() {
    echo '<h1>' . get_admin_page_title() . '</h1>';
    echo '<form action="options.php" method="post" name="nathaliephotos_settings">';
    echo '<div>';

    settings_fields('nathaliephotos_settings_fields');

    do_settings_sections('nathaliephotos_settings_section');

    submit_button();

    echo '</div>';
    echo '</form>';
}

add_action('admin_menu', 'nathaliephotos_add_admin_pages');

function nathaliephotos_settings_register() {
    register_setting('nathaliephotos_settings_fields', 'nathaliephotos_settings_fields', 'nathaliephotos_settings_fields_validate');
    add_settings_section('nathaliephotos_settings_section', __('Paramètres', 'nathaliephotos'), 'nathaliephotos_settings_section_introduction', 'nathaliephotos_settings_section');
    add_settings_field('nathaliephotos_settings_field_introduction', __('Introduction', 'nathaliephotos'), 'nathaliephotos_settings_field_introduction_output', 'nathaliephotos_settings_section', 'nathaliephotos_settings_section');
    add_settings_field('nathaliephotos_settings_field_phone_number', __('Numéro de téléphone', 'nathaliephotos'), 'nathaliephotos_settings_field_phone_number_output', 'nathaliephotos_settings_section', 'nathaliephotos_settings_section');
    add_settings_field('nathaliephotos_settings_field_email', __('Adresse Mail', 'nathaliephotos'), 'nathaliephotos_settings_field_email_output', 'nathaliephotos_settings_section', 'nathaliephotos_settings_section');
}
function nathaliephotos_settings_section_introduction() {

    _e('Paramètrez les différentes options de votre thème Nathaliephotos.', 'nathaliephotos');
    }

function nathaliephotos_settings_field_introduction_output() {
    $value = get_option('nathaliephotos_settings_field_introduction');
    echo '<input name="nathaliephotos_settings_field_introduction" type="text" value="'.$value.'" />';
}
function nathaliephotos_settings_field_phone_number_output() {
    $value = get_option('nathaliephotos_settings_field_phone_number');
    echo '<input name="nathaliephotos_settings_field_phone_number" type="text" value="'.$value.'" />';
}
function nathaliephotos_settings_field_email_output() {
    $value = get_option('nathaliephotos_settings_field_email');
    echo '<input name="nathaliephotos_settings_field_email" type="text" value="'.$value.'" />';
}
    
function nathaliephotos_settings_fields_validate($inputs) {
    if(!empty($_POST)){ 
        if(!empty($_POST['nathaliephotos_settings_field_introduction'])){
            update_option('nathaliephotos_settings_field_introduction', $_POST['nathaliephotos_settings_field_introduction']);}
        if(!empty($_POST['nathaliephotos_settings_field_phone_number'])){
            update_option('nathaliephotos_settings_field_phone_number', $_POST['nathaliephotos_settings_field_phone_number']);}
        if(!empty($_POST['nathaliephotos_settings_field_email'])){
            update_option('nathaliephotos_settings_field_email', $_POST['nathaliephotos_settings_field_email']);}
        }
    return $inputs;}
    
 add_action('admin_init', 'nathaliephotos_settings_register');
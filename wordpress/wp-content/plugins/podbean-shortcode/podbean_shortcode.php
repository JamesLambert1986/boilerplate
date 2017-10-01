<?php
/*
Plugin Name: podbean Shortcode
Plugin URI: https://wordpress.org/plugins/podbean-shortcode/
Author: podbean
Version: 1.0
Author URI: https://www.podbean.com
*/
function podbean_get_error($message) {
    return '<p>' . __('Error', 'podbean_shortcode') . ': ' . $message . '</p>';
}

function podbean_get_dimension($input, $default = '100%') {
    if (empty($input)) {
        return $default;
    }

    // Cleanup
    $input = strtolower(trim($input));

    // Accept a value without unit (px by default)
    if (preg_match('/^\d+$/', $input)) {
        return $input . 'px';
    } elseif (!preg_match('/^\d+(%|px)$/', $input)) {
        return $default;
    } else {
        return $input;
    }
}

function podbean_get_url($base_url, $params = array()) {
    // Filter out empty params
    foreach ($params as $key => $value) {
        if ($value === null || $value === '') {
            unset($params[$key]);
        }
    }

    // Covert boolean to strings
    foreach ($params as $key => $value) {
        if (is_bool($value)) {
            $params[$key] = $value ? 'true' : 'false';
        }
    }

    return $base_url . '?' . http_build_query($params);
}

function podbean_get_player($attributes) {
    // Get shortcode params
    $params = shortcode_atts(array(
        'from'                =>'shortcode',
        'vjs'                 => '1',
        'width'               => '100%',
        'height'              => '315px',
        'share'               => '1',
        'fonts'               => 'Helvetica',
        'auto'                => '0',
        'download'            => '0',
        'skin'                => '0',
        'resource'            => null,
        'domain'              => 'com',
    ), $attributes);

    // Ensure the resource has been provided
    if (empty($params['resource'])) {
        return podbean_get_error(__('The resource attribute is missing from the embed code.', 'podbean_shortcode'));
    }

    // Validate the resource
    $valid = preg_match('/^(user_id|blog_id|episode)=(\w+)(-(\w+))$/', strtolower(trim($params['resource'])), $matches);
    if (!$matches) {
        return podbean_get_error(__('The resource attribute is invalid.', 'podbean_shortcode'));
    }

    $resource_id   = $matches[2].$matches[3];

    // Get player size
    $width  = podbean_get_dimension($params['width'], '100%');
    $height = podbean_get_dimension($params['height'], '315px');
    

    if($params['domain']=='org'){
        $link_prefix = 'https://www.podbean.org/media/player/';
    }else{
        $link_prefix = 'https://www.podbean.com/media/player/';
    }

    // Build the url
    $player_url = podbean_get_url($link_prefix . $resource_id, array(
        'from'     => $params['from'],
        'vjs'      => $params['vjs'],
        'width'    => $params['width'],
        'height'   => $params['height'],
        'share'    => $params['share'],
        'fonts'    => $params['fonts'],
        'auto'     => $params['auto'],
        'download' => $params['download'],
        'skin'     => $params['skin'],
    ));

    return '<iframe src="' . esc_attr($player_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" frameborder="0"></iframe>';
}

function podbean_get_player_by_legacy_config($attributes) {
    // Get shortcode params
    $params = shortcode_atts(array(
        'from'                =>'shortcode',
        'width'               => '100%',
        'height'              => '100px',
        'share'               => '1',
        'fonts'               => 'Helvetica',
        'auto'                => '0',
        'download'            => '0',
        'skin'                => '0',
        'resource'            => null,
        'domain'              => 'com',
    ), $attributes);

    // Ensure the resource has been provided
    if (empty($params['resource'])) {
        return podbean_get_error(__('The resource attribute is missing from the embed code.', 'podbean_shortcode'));
    }

    // Validate the resource
    $valid = preg_match('/^(user_id|blog_id|episode)=(\w+)(-(\w+))$/', strtolower(trim($params['resource'])), $matches);
    if (!$matches) {
        return podbean_get_error(__('The resource attribute is invalid.', 'podbean_shortcode'));
    }

    $resource_id   = $matches[2].$matches[3];

    // Get player size
    $width  = podbean_get_dimension($params['width'], '100%');
    $height = podbean_get_dimension($params['height'], '100px');
    
    if($params['domain']=='org'){
        $link_prefix = 'https://www.podbean.org/media/player/';
    }else{
        $link_prefix = 'https://www.podbean.com/media/player/';
    }

    // Build the url
    $player_url = podbean_get_url($link_prefix . $resource_id, array(
        'from'     => $params['from'],
        'width'    => $params['width'],
        'height'   => $params['height'],
        'share'    => $params['share'],
        'fonts'    => $params['fonts'],
        'auto'     => $params['auto'],
        'download' => $params['download'],
        'skin'     => $params['skin'],
    ));

    return '<iframe src="' . esc_attr($player_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" frameborder="0"></iframe>';
}

function podbean_get_multi_player($attributes) {
    // Get shortcode params
    $params = shortcode_atts(array(
        'from'                =>'shortcode',
        'playlist'            => null,
        'vjs'                 => '1',
        'width'               => '100%',
        'height'              => '315px',
        'share'               => '1',
        'fonts'               => 'Helvetica',
        'auto'                => '0',
        'download'            => '0',
        'skin'                => '0',
        'domain'              => 'com',
    ), $attributes);

    // Ensure the resource has been provided
    if (empty($params['playlist'])) {
        return podbean_get_error(__('The playlist attribute is missing from the embed code.', 'podbean_shortcode'));
    }

    // Get player size
    $width  = podbean_get_dimension($params['width'], '100%');
    $height = podbean_get_dimension($params['height'], '315px');
    

    if($params['domain']=='org'){
        $player_link = 'https://www.podbean.org/media/player/multi';
    }else{
        $player_link = 'https://www.podbean.com/media/player/multi';
    }

    // Build the url
    $player_url = podbean_get_url($player_link, array(
        'from'     => $params['from'],
        'playlist' => $params['playlist'],
        'vjs'      => $params['vjs'],
        'width'    => $params['width'],
        'size'     => $params['height'],
        'share'    => $params['share'],
        'fonts'    => $params['fonts'],
        'auto'     => $params['auto'],
        'download' => $params['download'],
        'skin'     => $params['skin'],
    ));

    $height = trim($height,'px');
    $height = (int)$height + 200;

    return '<iframe src="' . esc_attr($player_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" frameborder="0"></iframe>';
}

function podbean_shortcode( $attributes ) {
    // Get the shortcode type
    $type = !empty($attributes['type']) ? $attributes['type'] : null;
    if (!$type) {
        // Backward compatibility (previous versions of the plugin didn't require the type attribute)
        return podbean_get_player($attributes);
    }

    switch($type) {
        case 'audio-rectangle':
            return podbean_get_player_by_legacy_config($attributes);
        case 'audio-square':
            return podbean_get_player($attributes);
        case 'video':
            return podbean_get_player($attributes);
        case 'multi':
            return podbean_get_multi_player($attributes);
        default:
            return podbean_get_error(__('The widget type is unsupported.', 'podbean_shortcode'));
    }
}

add_shortcode('podbean', 'podbean_shortcode');

?>

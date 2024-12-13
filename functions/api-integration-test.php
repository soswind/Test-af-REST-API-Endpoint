<?php

function hent_data_fra_api() {
  $url = 'https://www.lundhjemmesider-udvikling.dk/jumbotransport_dk/wp-json/wp/v2/posts';
  $args = array(
    'timeout' => 15,
    'headers' => array(
      'Authorization' => 'Basic ' . base64_encode('USERNAME:PASSWORD'),
      ),
    );
  $response = wp_remote_get($url, $args);

  if (is_wp_error($response)) {
    return 'Fejl ved hentning af data: ' . $response->get_error_message();
  }
  $data = wp_remote_retrieve_body($response);

  if (empty($data)) {
    return 'Ingen data modtaget.';
  }
  return json_decode($data);
}
function vis_data() {
  $data = hent_data_fra_api();

  if (is_string($data)) {
    return $data;
  }
  $output = '<ul>';
  foreach ($data as $item) {
    $output .= '<li>' . esc_html($item->title->rendered) . '<li>';
  }
  $output .= '<ul>';
  return $output;
}
add_shortcode('vis_news_dk_data', 'vis_data');
<?

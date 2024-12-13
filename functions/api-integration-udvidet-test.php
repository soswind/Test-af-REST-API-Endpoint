<?php

/**
 * JumboTransport REST API Test 2 (Udvidet)
 * Udvidet test af WordPress REST API integration.
 * Denne version henter og viser detaljeret information om posts,
 * inklusiv billeder, forfatterinformation og metadata.
 */

/**
 * Henter udvidet data fra WordPress REST API
 * Inkluderer _embed parameter for at hente relateret data som
 * featured images og forfatterinformation.
 */


function hent_data_fra_api() {
  $url = 'https://www.lundhjemmesider-udvikling.dk/jumbotransport_dk/wp-json/wp/v2/posts?order=desc&orderby=date&_embed';
  $args = $args = array(
        'timeout' => 5,
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

/**
 * Viser udvidet postinformation via shortcode [vis_news_dk_data]
 * Viser følgende for hver post:
 * - Titel
 * - Dato
 * - Indhold
 * - Uddrag
 * - Forfatterinformation
 * - Status
 * - Featured image (hvis tilgængeligt)
 */

function vis_data() {
  $data = hent_data_fra_api();
  if (is_string($data)) {
    return $data;
  }
  $output = '<ul>';
  foreach ($data as $item) {
    $output .= '<li>';
    $output .= '<h2>' . esc_html($item->title->rendered) . '</h2>';
    $output .= '<p><strong>Dato:</strong> ' . esc_html($item->date) . '</p>';
    $output .= '<div>' . wp_kses_post(esc_html($item->content->rendered) . '</div>';
    $output .= '<p><strong>Uddrag:</strong> ' wp_kses_post(esc_html($item->exerpt->rendered) . '</p>';
    $output .= '<p><strong>Forfatter ID:</strong> ' . esc_html($item->author) . '</p>';
    $output .= '<p><strong>Status:</strong> ' . esc_html($item->status) . '</p>';
    $output .= '<p><strong>Fremhævet billede ID:</strong> ' . esc_html($item->featured_media) . '</p>';
    if (!empty($item->featured_media)) {
      $image_sizes = isset($item->embedded->{'wp:featuredmedia'}) ? $item->_embedded->
        {'wp:featuredmedia'}[0]->media_details->sizes : null;
      if ($image_sizes) {
        if (isset($image_sizes->medium->source_url)) {
          $image_url = esc_url($image_sizes->medium->source_url);
          $output .= '<img src="' . $image_url . '" alt="' . esc_attr($item->title->rendered) . 
            '" class="responsive-image" style="max-width: 100%; height: auto; />';
        } elseif (isset($image_sizes->full->source_url)) {

          $image_url = esc_url($image_sizes->full->source_url);
          $output .= '<img src="' . $image_url . '" alt="' . esc_attr($item->title->rendered) . 
            '" class="responsive-image" style="max-width: 100%; height: auto; />';
        } else {
          $output .= '<p>Ingen billede tilgængeligt.</p>';
        }
      } else {
        $output .= '<p>Ingen billede tilgængelig.</p>';
      }
    }
    if (isset($item->_embedded->{'author'})) {
      $author_data = $item->_embedded->{'author'}[0];
      if (isset($author_data->name)) {
          $output .= '<p><strong>Forfatter:</strong> ' . esc_html($author_data->name) . '</p>';
      }
    }
    $output .= '</li>';
  }
  $output .= '</ul>';
  
  return $output;
}
add_shortcode('vis_news_dk_data', 'vis_data');
  

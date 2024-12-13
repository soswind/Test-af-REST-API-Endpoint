<?php

/** Visning af category parameter, der henter fra en specifik kategori */

function hent_data_fra_api() {
  $category_id = 13;

$url = 'https://www.lundhjemmesider-udvikling.dk/jumbotransport_dk/wp-json/wp/v2/posts?order=desc&orderby=date&_embed&categories=' . $category_id;

<?

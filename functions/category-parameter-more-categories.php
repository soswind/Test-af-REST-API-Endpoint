<?php

/** Visning af category parameter, der henter flere kategorier */

function hent_data_fra_api($category_id) {
  $category_id = 13;

$url = 'https://www.lundhjemmesider-udvikling.dk/jumbotransport_dk/wp-json/wp/v2/posts?order=desc&orderby=date&_embed&categories=13,10';

<?

<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config = array(
	'per_page' => 5,
    'base_url' => site_url(),
    'total_rows' => 0,
    'query_string_segment' => 'start',
    'full_tag_open' => '<ul class="pagination justify-content-center">',
    'first_tag_open' => '<li class="page-item">',
    'first_link' => "Прва",
    'first_tag_close' => '</li>',
    'last_tag_open' => '<li class="page-item">',
    'last_link' => "Посљедња",
    'last_tag_close' => '</li>',
    'next_tag_open' => '<li class="page-item">',
    'next_link' => 'Сљедећа',
    'next_tag_close' => '</li>',
    'prev_tag_open' => '<li class="page-item">',
    'prev_link' => 'Претходна',
    'prev_tag_close' => '</li>',
    'cur_tag_open' => '<li class="page-item"><a class="page-link">',
    'cur_tag_close' => '</a></li>',
    'num_tag_open' => '<li class="page-item">',
    'num_tag_close' => '</li>',
    'full_tag_close' => '</ul>',
    'page_query_string' => TRUE,
    'attributes' => array('class' => 'page-link'),
    'num_links' => 9,
);
<?php
/**
 * The Template for displaying docs in a doc category. Simply includes the archive template.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/single-doc-header.php.
 *
 * HOWEVER, on occasion SmartDocs will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package     SmartDocs\Templates
 * @version     1.0.0		
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}

smartdocs_get_template( 'archive-smart-docs' );

<?php

    /**
     * test delle variabili
     *
     *
     *
     * @todo documentare
     *
     * @file
     *
     */

    // inclusione del framework
	require '../../../_src/_config.php';

    // debug
	ini_set( 'display_errors', 1 );
	ini_set( 'display_startup_errors', 1 );
	error_reporting( E_ALL );

    // ordinamento degli array per la scrittura
	rksort( $cf );

    // output
	$tx	= NULL;
	$tx	.= '<html>';
	$tx	.= '<head></head>';
	$tx	.= '<body>';
	$tx	.= '<ul>';

    // array da stampare
	$print = $cf;

    // censuro l'array per evitare fughe accidentali di informazioni sensibili
	array2censored( $cf );

    // scendo nell'array
	if( isset( $_REQUEST['lvl'] ) && is_array( $_REQUEST['lvl'] ) ) {
	    foreach( $_REQUEST['lvl'] as $lvl ) {
#		echo $lvl . PHP_EOL;
		if( isset( $print[ $lvl ] ) ) {
#		    print_r( $print );
#		    echo $lvl . ' presente in: ' . print_r( $print, true );
		    $print = $print[ $lvl ];
#		} else {
#		    echo $lvl . ' non presente in: ' . print_r( $print, true );
		}
	    }
	} else {
	    $_REQUEST['lvl'] = array();
	}

    // debug
	// print_r( $print );

    // stampa
	if( empty( $print ) ) {
	    $tx .= '<li>(vuoto)</li>';
	} else {
	    foreach( array_keys( $print ) as $key ) {
#		echo $key . PHP_EOL;
		$qs['lvl'] = array_merge( $_REQUEST['lvl'], array( $key ) );
		if( is_array( $print[ $key ] ) ) {
#		    echo 'array' . PHP_EOL;
#		    $tx .= '<a href="?' . urlencode( http_build_query( $qs ) ) . '">' . $key . '</a><br/>';
		    $tx .= '<li><a href="?' . htmlentities( http_build_query( $qs ) ) . '">' . $key . '</a></li>';
		} else {
#		    echo 'stringa' . PHP_EOL;
		    $tx .= '<li>' . $key . ' &#x2192; ' . ( ( empty( $print[ $key ] ) ) ? '(vuoto)' : $print[ $key ] ) . '</li>';
		}
	    }
	}

    // debug
	// echo '<pre>' . print_r( $_REQUEST, true ) . '</pre>';
	// echo '<pre>' . print_r( $cf, true ) . '</pre>';

    // output
	$tx	.= '</ul>';
	$tx	.= '</body>';
	$tx	.= '</html>';

    // output
	buildHtml( $tx );

?>

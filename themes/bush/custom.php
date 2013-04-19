<?php

/*
 * @copyright Garrick S. Bodine, 2012
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

// basically, this is just the Omeka simple_search minus the hardcoded fieldset and some added Bootstrap classes:
function custom_simple_search($buttonText = null, $formProperties=array('id'=>'simple-search'), $uri = null) {
    /*
    if (!$buttonText) {
        $buttonText = __('Search');
    }
    */
    if (!$uri) {
        $uri = apply_filters('simple_search_default_uri', uri('items/browse'));
    }

    $searchQuery = array_key_exists('search', $_GET) ? $_GET['search'] : '';
    $formProperties['action'] = $uri;
    $formProperties['method'] = 'get';
    $html  = '<form ' . _tag_attributes($formProperties) . '><fieldset>';
    $html .= __v()->formText('search', $searchQuery, array('name'=>'search','class'=>'textinput'));
    $html .= __v()->formSubmit('submit_search', $buttonText, array('class'=>'icon-search'));

    $parsedUri = parse_url($uri);
    if (array_key_exists('query', $parsedUri)) {
        parse_str($parsedUri['query'], $getParams);
        foreach($getParams as $getParamName => $getParamValue) {
            $html .= __v()->formHidden($getParamName, $getParamValue);
        }
    }

    $html .= '</fieldset></form>';
    return $html;
}


function custom_header_logo() {
	$header_text =  '
				<div id="header-img">
					<a href="'. WEB_ROOT .'"><img src="'. WEB_ROOT . '/themes/bush/img/project_logo.png"
						height="50" width="584"
						alt="Arkivat Shkoder" /></a>
				</div>
				<div id="header-img-print">
					<a href="'. WEB_ROOT .'"><img src="' . WEB_ROOT . '/themes/bush/img/project_logo_black.png"
						height="50" width="584"
						alt="Arkivat Shkoder" /></a>
				</div>
			';
	return $header_text;
}

function filesize_formatted( $size ) {
    //$size = filesize($path);
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}

?>

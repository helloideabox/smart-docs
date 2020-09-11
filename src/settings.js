import Options from './Options';
/**
 * WordPress dependencies.
 */

import {render, Fragment} from '@wordpress/element';

console.log("Settings Loaded");

render(
	<Options />,
	document.getElementById( 'ed-setting-root' )
);
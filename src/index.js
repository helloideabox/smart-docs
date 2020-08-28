import Options from './Options';
/**
 * WordPress dependencies.
 */
const {
	render,
	Fragment
} = wp.element;

render(
	<Options />,
	document.getElementById( 'ed-setting-root' )
);
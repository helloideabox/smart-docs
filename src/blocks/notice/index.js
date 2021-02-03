import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

import edit from './edit';
import save from './save';

import './style.scss';

registerBlockType( 'smartdocs/notice', {
	title: __( 'Notice', 'smart-docs' ),
	description: __(
		'A Gutenberg block for adding Notice to your page.',
		'smart-docs'
	),
	icon: 'info',
	category: 'smart-docs',
	keywords: [ "notice", "alert", "warning", "message" ],
	attributes: {
		info: {
			type: 'string',
			source: 'html',
			selector: 'p',
			default: 'Message'
		},
		msg_type: {
			type: 'string',
			default: 'warn'
		}
	},
	edit,
	save,
} );

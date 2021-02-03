import { RichText, BlockControls } from "@wordpress/block-editor";
import { Toolbar, DropdownMenu } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

import './editor.scss';

const edit = ( props ) => {
	const { className, attributes, setAttributes } = props;
	const { info, msg_type } = attributes;

	const onChangeInfo = ( newVal ) => {
		setAttributes( { info: newVal } );
	}

	const onChangeMsgType = ( newVal ) => {
		setAttributes( { msg_type: newVal } );
	}

	return (
		<>
			<BlockControls>
				<Toolbar>
					<DropdownMenu
						icon="editor-table"
						label={ __( 'Notice', 'smart-docs' ) }
						controls={[
							[{
								icon: 'dismiss',
								title: __( 'Error', 'smart-docs' ),
								onClick: () => onChangeMsgType('error'),
								isActive: false
							}],
							[{
								icon: 'warning',
								title: __( 'Warning', 'smart-docs' ),
								onClick: () => onChangeMsgType('warn'),
								isActive: true
							}],
							[{
								icon: 'info',
								title: __( 'Info', 'smart-docs' ),
								onClick: () => onChangeMsgType('info'),
								isActive: false
							}],
							[{
								icon: 'yes-alt',
								title: __( 'Success', 'smart-docs' ),
								onClick: () => onChangeMsgType('success'),
								isActive: false
							}]
						]}
					/>
				</Toolbar>
			</BlockControls>
			<div className={ className }>
				<div className={ `smartdocs-block-notice notice-${ msg_type }` }>
					<RichText
						tagName="p"
						onChange={ onChangeInfo }
						value={info}
						placeholder={ __( "Notice Info", "smart-docs" ) }
					/>
				</div>
			</div>
		</>
	);
}

export default edit;

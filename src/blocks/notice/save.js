import { RichText } from "@wordpress/block-editor";

const save = ( props ) => {
	const { attributes } = props;
	const { info, msg_type } = attributes;
	return(
		<div>
			<div className={ `smartdocs-block-notice notice-${ msg_type }` }>
				<RichText.Content
					tagName="p"
					value={info}
				/>
			</div>
		</div>
	)
}

export default save;

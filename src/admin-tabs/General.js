/**
 * WordPress Dependencies
 */

 const { useEntityProp } = wp.coreData;

 import { __ } from '@wordpress/i18n';

 import { BaseControl, Button } from '@wordpress/components';

 export default function GeneralOptions(){

    const [ ed_archive_page_title, setArchivePageTitle ] = useEntityProp(
        'root',
        'site',
        'ed_archive_page_title'
    );

    return (
        <BaseControl
								label={ __( 'Doc Archive Page Title' ) }
								help={ __( 'If you want to change the title of archive page.' ) }
								id="ed-option-doc_archive-page-title"
								className="ed-setting-text-field"
							>
								<input
									type="text"
									id="ed-option-doc_archive-page-title"
									value={ this.state.archive_page_title }
									placeholder={ __( 'Title' ) }
									onChange={ e => this.setState({ archive_page_title: e.target.value }) }
								/>

							<div className="ed-save-setting">
								<Button
									type = "button"
									isPrimary
									onClick={ setArchivePageTitle }
								>
									{ __( 'Save Changes' ) }
								</Button>
							</div>
							</BaseControl>
    )

 }
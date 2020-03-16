import './Options.scss';
import ReactNotification, { store } from 'react-notifications-component';
import 'react-notifications-component/dist/theme.css';


/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;

const {
	BaseControl,
	Button,
	PanelBody,
	PanelRow,
	Spinner,
	Placeholder,
	ToggleControl,
} = wp.components;

const {
	render,
	Component,
	Fragment
} = wp.element;




class Options extends Component {
	constructor( props ) {
		super( props );

		// To handle different states from input.
		this.state = {
			archive_page_title               : 'Docs',
			post_types                       : [],
			enable_single_template           : true,
			enable_category_and_tag_template : true,
			turnoff_doc_comment              : false,
			enable_live_search               : true,
			show_last_update_time            : true,
			isAPILoaded                      : false,
			isAPISaving                      : false,
		};


		// Binding event function.
		this.changeOptions = this.changeOptions.bind(this);
		this.addNotification = this.addNotification.bind(this);
	}


	async componentDidMount() {
		wp.api.loadPromise.then( () => {
			this.easydoc = new wp.api.models.Settings();

			if( ! this.state.isAPILoaded ) {
				this.easydoc.fetch().then( response => {
					console.log( response );

					this.setState( {
						archive_page_title               : response.ed_archive_page_title,
						post_types                       : response.ed_post_type_selected,
						enable_single_template           : Boolean( response.ed_enable_single_template ),
						enable_category_and_tag_template : Boolean( response.ed_enable_category_and_tag_template ),
						turnoff_doc_comment              : Boolean( response.ed_turnoff_doc_comment ),
						enable_live_search               : Boolean( response.ed_enable_live_search ),
						show_last_update_time            : Boolean( response.ed_show_last_update_time ),
						isAPILoaded                      : true
					} );
				} );
			}
		} );
	}


	// Hanadling the change in different input field.
	changeOptions( option, value, state ) {
		
		this.setState( { isAPISaving : true } );
		this.addNotification( 'updating', __( 'Updating Settings...' ), 'info' );


		const model = new wp.api.models.Settings({
			[option] : value,
		});


		model.save().then( ( response, status ) => {
			store.removeNotification( 'updating' );
			console.log( response[option] );
			console.log( status );

			if ( 'success' == status ) {
				this.setState( {
					[state]       : response[option],
				} );
			
				this.addNotification( 'saved', __( 'Settings Saved' ), 'success' );
				this.setState( { isAPISaving : false } );
			}
		});
	}


	// Handling the notification for state updating.
	addNotification( id, message, status ) {
		store.addNotification({
			id: id,
			message: message,
			slidingEnter: {
				duration: 0,
				delay: 0
			},
            type: status,                            // 'default', 'success', 'info', 'warning'
            container: 'bottom-left',                // where to position the notifications
            animationIn: ["animated", "fadeIn"],     // animate.css classes that's applied
            animationOut: ["animated", "fadeOut"],   // animate.css classes that's applied
            dismiss: {
			  duration: 2000,
			  showIcon: true,
			},
          })
	}



	// Returning the output.
	render() {
		if( ! this.state.isAPILoaded ) {
			return (
				<Placeholder>
					<Spinner />
				</Placeholder>
			)
		}


		return (
			<Fragment>
				<ReactNotification />

				<div className="ed-setting-header">
					<div className="ed-setting-container">
						<div className="ed-setting-logo">
							<h1>{ __( 'Easy Doc Setting' ) }</h1>
						</div>
					</div>
				</div>

				<div className="ed-setting-main">
					<PanelBody
						title={ __( "General" ) }
					>
						<PanelRow>
							<BaseControl
								label={ __( 'Doc Archive Page Title' ) }
								help={ __( 'If you want to change the title of archive page.' ) }
								id="ed-option-doc_archive-page-title"
								className="ed-setting-text-field"
							>
								<input
									type="text"
									disabled={ this.state.isAPISaving }
									id="ed-option-doc_archive-page-title"
									value={ this.state.archive_page_title }
									placeholder={ __( 'Title' ) }
									onChange={ e => this.setState({ archive_page_title: e.target.value }) }
								/>

							<div className="ed-save-setting">
								<Button
									type = "button"
									isPrimary
									isLarge
									onClick={ () => this.changeOptions( 'ed_archive_page_title', this.state.archive_page_title, 'archive_page_title' ) }
								>
									{ __( 'Save Changes' ) }
								</Button>
							</div>
							</BaseControl>
						</PanelRow>

						<PanelRow>
							<div className="ed-label ed-live-search-enable" >
								<ToggleControl
									label={ __( "Enable Live Search", 'easydoc' ) }
									help={ this.state.enable_live_search ? 'Live Search is good to go.' : 'No more live search.' }
									checked={ this.state.enable_live_search }
									onChange={ () => this.changeOptions( 'ed_enable_live_search', ! this.state.enable_live_search, 'enable_live_search' ) }
								/>
							</div>
						</PanelRow>

						<PanelRow>
							<div className="ed-label ed-single-page-template" >
								<ToggleControl
									label={ __( "Enable built-in Single page Template", 'easydoc' ) }
									help={ this.state.enable_single_template ? 'Custom Single page template enabled.' : 'Custom Single page template disabled.' }
									checked={ this.state.enable_single_template }
									onChange={ () => this.changeOptions( 'ed_enable_single_template', ! this.state.enable_single_template, 'enable_single_template' ) }
								/>
							</div>
						</PanelRow>

						<PanelRow>
							<div className="ed-post_types">
								<label>{ __( 'Search within Post Types' ) }</label>
								<ul>
								{
									Object.keys( ed_vars.post_types ).map( (item) => (
									<li>
										<ToggleControl
											label={ ed_vars.post_types[ item ] }
											checked={ this.state.post_types.some( (value) => value === item ) }
											onChange={ ( isChecked ) => {
												// Destructing the object.
												let {post_types} = this.state;
												// Checking for true or false.
												if ( isChecked ) {
													post_types.push( item );
												} else {
													let itemIndex = post_types.indexOf( item );
													post_types.splice( itemIndex, 1 );
												}									
												this.changeOptions( 'ed_post_type_selected', this.state.post_types, 'post_types' )			
											}  }
										/>
									</li>
									) )
								}
								</ul>
								<p className="ed-help">{ __( 'Expand live search by enabling diffrent post type options.' ) }</p>
							</div>
						</PanelRow>

						<PanelRow>
							<div className="ed-label ed-category-and-tag-template" >
								<ToggleControl
									label={ __( "Enable built-in Category and Tag page Template", 'easydoc' ) }
									help={ this.state.enable_single_template ? 'Category and Tag page template enabled.' : 'Category and Tag page template enabled.' }
									checked={ this.state.enable_category_and_tag_template }
									onChange={ () => this.changeOptions( 'ed_enable_category_and_tag_template', ! this.state.enable_category_and_tag_template, 'enable_category_and_tag_template' ) }
								/>
							</div>
						</PanelRow>
					</PanelBody>

					<PanelBody title={ __( "Miscellaneous" ) }>
						<PanelRow>
							<div className="ed-label ed-doc-comment" >
								<ToggleControl
									label={ __( "Turn Off Doc Comment", 'easydoc' ) }
									help={ this.state.turnoff_doc_comment ? 'Doc comments are turned off for now.' : 'Doc comments are visible.' }
									checked={ this.state.turnoff_doc_comment }
									onChange={ () => this.changeOptions( 'ed_turnoff_doc_comment', ! this.state.turnoff_doc_comment, 'turnoff_doc_comment' ) }
								/>
							</div>
						</PanelRow>

						<PanelRow>
							<div className="ed-label ed-doc-lastupdate" >
								<ToggleControl
									label={ __( "Show Last Update Time", 'easydoc' ) }
									help={ this.state.show_last_update_time ? 'You can now see the last updated time of the post.' : 'Last updated time of the post is kept hidden.' }
									checked={ this.state.show_last_update_time }
									onChange={ () => this.changeOptions( 'ed_show_last_update_time', ! this.state.show_last_update_time, 'show_last_update_time' ) }
								/>
							</div>
						</PanelRow>
					</PanelBody>
				</div>
			</Fragment>
		);
	}
}



export default Options;
import './Options.scss';


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
			isAPILoaded                      : false,
			isAPISaving                      : false,
		};


		// Binding event function.
		this.handleSubmit = this.handleSubmit.bind(this);
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
						isAPILoaded                      : true
					} );
				} );
			}
		} );
	}




	// Hanadling the form submit.
	handleSubmit( e ) {
		// Preventing the default submit action.
		e.preventDefault();
		this.setState( { isAPISaving : true } );


		const model = new wp.api.models.Settings({
			[ 'ed_archive_page_title' ] : this.state.archive_page_title,
			[ 'ed_post_type_selected' ] : this.state.post_types,
			[ 'ed_enable_single_template' ] : this.state.enable_single_template,
			[ 'ed_enable_category_and_tag_template' ] : this.state.enable_category_and_tag_template,
			[ 'ed_turnoff_doc_comment' ] : this.state.turnoff_doc_comment,
			[ 'ed_enable_live_search' ] : this.state.enable_live_search,
		});


		model.save().then( response => {
			console.log( response );

			this.setState( {
				archive_page_title               : response.ed_archive_page_title,
				post_types                       : response.ed_post_type_selected,
				enable_single_template           : Boolean( response.ed_enable_single_template ),
				enable_category_and_tag_template : Boolean( response.ed_enable_category_and_tag_template ),
				turnoff_doc_comment              : Boolean( response.ed_turnoff_doc_comment ),
				enable_live_search               : Boolean( response.ed_enable_live_search ),
				isAPISaving                      : false
			} );
		});
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
				<div className="ed-setting-header">
					<div className="ed-setting-container">
						<div className="ed-setting-logo">
							<h1>{ __( 'Easy Doc Setting' ) }</h1>
						</div>
					</div>
				</div>

				<div className="ed-setting-main">
					<form onSubmit={ this.handleSubmit }>
						<PanelBody
							title={ __( "Settings" ) }
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
								</BaseControl>
							</PanelRow>

							<PanelRow>
								<div className="ed-label ed-live-search-enable" >
									<ToggleControl
										label={ __( "Enable Live Search", 'easydoc' ) }
										help={ this.state.enable_live_search ? 'Live Search is good to go.' : 'No more live search.' }
										checked={ this.state.enable_live_search }
										onChange={ () => this.setState( ( state ) => ( { enable_live_search: ! state.enable_live_search } ) ) }
									/>
								</div>
							</PanelRow>

							<PanelRow>
								<div className="ed-label ed-single-page-template" >
									<ToggleControl
										label={ __( "Enable built-in Single page Template", 'easydoc' ) }
										help={ this.state.enable_single_template ? 'Custom Single page template enabled.' : 'Custom Single page template disabled.' }
										checked={ this.state.enable_single_template }
										onChange={ () => this.setState( ( state ) => ( { enable_single_template: ! state.enable_single_template } ) ) }
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
													this.setState( { post_types } );			
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
										onChange={ () => this.setState( ( state ) => ( { enable_category_and_tag_template: ! state.enable_category_and_tag_template } ) ) }
									/>
								</div>
							</PanelRow>

							<PanelRow>
								<div className="ed-label ed-doc-comment" >
									<ToggleControl
										label={ __( "Turn Off Doc Comment", 'easydoc' ) }
										help={ this.state.turnoff_doc_comment ? 'Doc comments are turned off for now.' : 'Doc comments are visible.' }
										checked={ this.state.turnoff_doc_comment }
										onChange={ () => this.setState( ( state ) => ( { turnoff_doc_comment: ! state.turnoff_doc_comment } ) ) }
									/>
								</div>
							</PanelRow>

							<div className="ed-save-setting">
								<Button
									type = "submit"
									isPrimary
									isLarge
								>
									{ __( 'Save Changes' ) }
								</Button>
							</div>
						</PanelBody>
					</form>
				</div>
			</Fragment>
		);
	}
}



export default Options;
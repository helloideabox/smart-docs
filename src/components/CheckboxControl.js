import React from 'react';


export class CheckboxControl extends React.Component {
	constructor( props ) {
		super( props );

		this.handleChange = this.handleChange.bind( this );
	}

	handleChange(e) {
		this.props.onChange( e.target.checked );
	}


	render() {
		return (
			<div className="components-base-control">
				<div className="components-base-control__field">
					<label className="components-base-control__label" for="inspector-checkbox-control-0">{ this.props.label }</label>
					<input id="inspector-checkbox-control-0" className="components-checkbox-control__input" type="checkbox" onChange={this.handleChange} ></input>
				</div>
			</div>
		)
	}
}
import { map } from "lodash";
import { TabPanel } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

import General from "./tabs/General";
import Advanced from "./tabs/Advanced";

export default function Tabs() {

	const tabClasses = "smartdocs-setting-primary-tab px-4 text-sm";

	const getTabs = () => {
		const tabs = smartdocs_admin.setting_tabs;
		const data = [];

		// let's sort the tabs by priority.
		const sortedTabs = Object.entries(tabs)
			.sort( ( [,a], [,b] ) => a.priority - b.priority )
			.reduce( ( accum, [ key, value ] ) => ( { ...accum, [ key ]: value } ), {} );

		map( sortedTabs, ( tab, name ) => {
			if ( 'undefined' !== typeof tab ) {
				data.push( {
					name,
					title: tab.title,
					className: tabClasses
				} );
			}
		} );

		return data;
	};
	
	return (
		<TabPanel
			className="smartdocs-settings-tabs m-5 col-span-2 row-span-2 bg-white"
			activeClass="is-active"
			tabs={ getTabs() }
		>
			{ (tab) => {
				if ( 'general' === tab.name ) {
					return <General />;
				} else if ( 'advanced' === tab.name ) {
					return <Advanced />;
				} else {
					return (
						<div id={`smartdocs-tab-content-${ tab.name }`}></div>
					)
				}
			} }
		</TabPanel>
	);
}

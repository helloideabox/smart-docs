import { TabPanel } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

import General from "./tabs/General";
import Advanced from "./tabs/Advanced";

export default function Tabs() {

	const tabClasses = "smartdocs-setting-primary-tab px-4 text-sm";
	
	return (
		<TabPanel
			className="smartdocs-settings-tabs m-5 col-span-2 row-span-2 bg-white"
			activeClass="is-active"
			tabs={[
				{
					name: 'general',
					title: __( 'General', 'smart-docs' ),
					className: tabClasses,
				},
				{
					name: 'advanced',
					title: __( 'Advanced', 'smart-docs' ),
					className: tabClasses,
				},
			]}
		>
			{(tab) => {
				if ( 'general' === tab.name ) {
					return <General />;
				} else if ( 'advanced' === tab.name ) {
					return <Advanced />;
				}
			}}
		</TabPanel>
	);
}

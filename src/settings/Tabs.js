import { TabPanel } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

import General from "./tabs/General";
import Search from "./tabs/Search";

export default function Tabs() {

	const tabClasses = "smartdocs-setting-primary-tab px-4 text-sm";
	
	return (
		<TabPanel
			className="smartdocs-settings-tabs m-5 col-span-2 row-span-2 bg-white"
			activeClass="is-active"
			tabs={[
				{
					name: "general",
					title: __( 'General', 'smart-docs' ),
					className: tabClasses,
				},
				{
					name: "search",
					title: __( 'Search', 'smart-docs' ),
					className: tabClasses,
				},
			]}
		>
			{(tab) => {
				if ("general" === tab.name) {
					return <General />;
				} else if ("search" === tab.name) {
					return <Search />;
				}
			}}
		</TabPanel>
	);
}

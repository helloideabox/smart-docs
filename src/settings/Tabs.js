import { Fragment } from "@wordpress/element";
import { TabPanel } from "@wordpress/components";
import General from "./tabs/General";
import Layout from "./tabs/Layout";
import Search from "./tabs/Search";

export default function Tabs() {
	const tabClasses = "sd-setting-primary-tab px-4 text-base duration-200";
	return (
		<TabPanel
			className="sd-settings-tabs m-5 col-span-2 row-span-2 bg-white"
			activeClass="is-active"
			tabs={[
				{
					name: "general",
					title: "General",
					className: tabClasses,
				},
				{
					name: "layout",
					title: "Layout",
					className: tabClasses,
				},
				{
					name: "search",
					title: "Search",
					className: tabClasses,
				},
			]}
		>
			{(tab) => {
				if ("general" === tab.name) {
					return <General />;
				} else if ("layout" === tab.name) {
					return <Layout />;
				} else if ("search" === tab.name) {
					return <Search />;
				}
			}}
		</TabPanel>
	);
}

import { TabPanel } from "@wordpress/components";
import DocPage from "./DocPage";
import SinglePage from "./SinglePage";
import ArchivePage from "./ArchivePage";

export default function Layout() {
	const tabClasses = "py-3 px-4 text-sl duration-200";

	return (
		<TabPanel
			className="sd-layout-settings-tabs flex"
			activeClass="is-active"
			orientation="vertical"
			tabs={[
				{
					name: "documentation_page",
					title: "Doc Page",
					className: tabClasses,
				},
				{
					name: "single_page",
					title: "Single Page",
					className: tabClasses,
				},
				{
					name: "archive_page",
					title: "Archive Page",
					className: tabClasses,
				},
			]}
		>
			{(tab) => {
				if ("documentation_page" === tab.name) {
					return <DocPage />;
				} else if ("single_page" === tab.name) {
					return <SinglePage />;
				} else if ("archive_page" === tab.name) {
					return <ArchivePage />;
				}
			}}
		</TabPanel>
	);
}

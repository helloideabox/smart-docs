/**
 * WordPress Dependencies
 */
import { useEffect, render } from "@wordpress/element";

/**
 * Internal dependencies.
 */
import "./index.scss";
import Header from "./Header";
import Tabs from "./Tabs";
import SidePanel from "./SidePanel";
import SettingNotices from "./notices/notices";

const App = () => {

	return (
		<>
			<Header />
			<div className="grid grid-cols-3 grid-rows-2 container mx-auto">
				<Tabs />
				<SidePanel />
			</div>
			<SettingNotices />
		</>
	);
};

setTimeout(() => {
	render(
		<App />,
		document.getElementById("smartdocs-setting-root")
	);
}, 0);

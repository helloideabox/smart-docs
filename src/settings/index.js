/**
 * WordPress Dependencies
 */
import { Fragment, useEffect, render } from "@wordpress/element";

/**
 * Internal dependencies.
 */
import "./index.scss";
import Header from "./Header";
import Tabs from "./Tabs";
import SidePanel from "./SidePanel";
import SettingNotices from "./notices/notices";

const loader = document.querySelector(".loader");
// Show the loader when React loads data again
const showLoader = () => loader.classList.remove("loader--hide");
const hideLoader = () => loader.classList.add("loader--hide");

const App = ({ hideLoader }) => {

	useEffect(hideLoader, []);

	return (
		<Fragment>
			<Header />
			<div className="grid grid-cols-3 grid-rows-2 container mx-auto">
				<Tabs />
				<SidePanel />
			</div>
			<SettingNotices />
		</Fragment>
	);
};

setTimeout(() => {
	render(
		<App hideLoader={hideLoader} showLoader={showLoader} />,
		document.getElementById("smartdocs-setting-root")
	);
}, 0);

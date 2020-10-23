/*CSS*/
import "./index.scss";

/*Custom Components*/

import Header from "./Header";
import Tabs from "./Tabs";
import SidePanel from "./SidePanel";

/**
 * WordPress Dependencies
 */
import { Fragment, useEffect } from "@wordpress/element";
import SettingNotices from "./notices/notices";

const loader = document.querySelector(".loader");
// if you want to show the loader when React loads data again
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

/**
 * WordPress Dependencies
 */

import { render } from "@wordpress/element";

setTimeout(() => {
	render(
		<App hideLoader={hideLoader} showLoader={showLoader} />,
		document.getElementById("sd-setting-root")
	);
}, 0);

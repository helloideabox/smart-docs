import "./index.scss";
import Header from "./Header";
import Tabs from "./Tabs";
import SidePanel from "./SidePanel";
import { Fragment } from "@wordpress/element";

/**
 * WordPress Dependencies
 */

import { render } from "@wordpress/element";

render(
	<Fragment>
		<Header />
		<div className="grid grid-cols-3">
			<Tabs />
			<SidePanel />
		</div>
	</Fragment>,
	document.getElementById("sd-setting-root")
);

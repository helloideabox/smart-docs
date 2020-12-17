/**
 * WordPress Dependencies
 */

import { __ } from "@wordpress/i18n";

import { Fragment } from "@wordpress/element";

export default function Header() {
	return (
		<Fragment>
			<div
				id="smartdocs-setting-header"
				className=" mx-auto flex justify-center justify-items-center p-10 mb-8 shadow bg-white "
			>
				<h2 className="text-5xl">Smart Docs</h2>
				<sup className="text-sm text-gray-500">v {smartdocs_admin.version}</sup>
			</div>
		</Fragment>
	);
}

/**
 * WordPress Dependencies
 */

import { __ } from "@wordpress/i18n";

import { Fragment } from "@wordpress/element";

export default function Header() {
	return (
		<Fragment>
			<div
				id="sd-setting-header"
				class="container mx-auto flex justify-center justify-items-center p-10 mb-8 shadow bg-white "
			>
				<h2 class="text-5xl">Smart Docs</h2>
				<sup class="text-sm text-gray-500">v {sd_vars.version}</sup>
			</div>
		</Fragment>
	);
}

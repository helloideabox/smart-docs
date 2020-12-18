/**
 * WordPress Dependencies
 */

import { __ } from "@wordpress/i18n";

export default function Header() {
	return (
		<>
			<div
				className="smartdocs-settings-header mx-auto flex justify-center justify-items-center p-10 mb-8 bg-white"
			>
				<h2 className="text-5xl">Smart Docs</h2>
				<sup className="text-sm text-gray-500">v{ smartdocs_admin.version }</sup>
			</div>
		</>
	);
}

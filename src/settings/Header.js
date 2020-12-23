export default function Header() {
	return (
		<div
			className="smartdocs-settings-header mx-auto flex justify-center justify-items-center mb-8 bg-white"
		>
			<div className="smartdocs-logo"><img src={ smartdocs_admin.logo_url } alt="Smart Docs" /></div>
			<div className="smartdocs-version text-sm text-gray-500"><span>{ smartdocs_admin.version }</span></div>
		</div>
	);
}

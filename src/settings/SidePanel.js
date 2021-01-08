import {
	Card,
	CardBody,
	CardHeader,
	CardFooter,
	ExternalLink,
} from "@wordpress/components";

import { __ } from "@wordpress/i18n";

export default function SidePanel() {
	return (
		<Card className="smartdocs-side-card col-span-1 m-5 h-fit-content">
			<CardHeader className="smartdocs-card-header font-bold text-lg pl-5 pt-4 pb-3">{ __( 'Help or Support', 'smart-docs' ) }</CardHeader>
			<CardBody>
				{ __( 'Stuck at somewhere? Need help?', 'smart-docs' ) }
				<br />
				<ExternalLink href="https://www.wpsmartdocs.com/docs/">
					{ __( 'Check out our Documentation', 'smart-docs' ) }
				</ExternalLink>
				<br /><br />
				{ __( 'Have any questions? Need basic support?', 'smart-docs' ) }
				<br />
				<ExternalLink href="https://wordpress.org/support/plugin/smart-docs/">
					{ __( 'Visit plugin\'s support forum', 'smart-docs' ) }
				</ExternalLink>
				<br /><br />
				{ __( 'Found an issue? or Have a suggestion?', 'smart-docs' ) }
				<br />
				<ExternalLink href="https://github.com/helloideabox/smart-docs/issues">
					{ __( 'Headover to GitHub Repository', 'smart-docs' ) }
				</ExternalLink>
			</CardBody>
		</Card>
	);
}

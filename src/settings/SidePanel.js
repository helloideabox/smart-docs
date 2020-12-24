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
				{ __( 'Found an issue? or Have a suggestion?', 'smart-docs' ) }
				<br />
				<br />
				{ __( 'We use GitHub to track issues and suggestions. Click the link below to go to our GitHub Page and post issue/suggestion.', 'smart-docs' ) }
			</CardBody>
			<CardFooter className="smartdocs-card-footer pt-4 pb-4">
				<ExternalLink className="w-full inline-flex font-medium text-sm" href="https://github.com/helloideabox/smart-docs/issues">
					{ __( 'Raise a Ticket', 'smart-docs' ) }
				</ExternalLink>
			</CardFooter>
		</Card>
	);
}

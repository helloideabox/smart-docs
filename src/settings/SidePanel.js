import {
	Card,
	CardBody,
	CardHeader,
	CardFooter,
	ExternalLink,
} from "@wordpress/components";

export default function SidePanel() {
	return (
		<Card className="smartdocs-side-card col-span-1 m-5 h-fit-content">
			<CardHeader className="smartdocs-card-header font-bold text-lg pl-5 pt-4 pb-3">Help or Support</CardHeader>
			<CardBody>
				Found a issue? or Have a suggestion? <br />
				<br />
				We use Github to track issues and suggestions. Click the link below to
				go to our Github Page and post issue/suggestion.
			</CardBody>
			<CardFooter className="smartdocs-card-footer pt-4 pb-4">
				<ExternalLink className="w-full inline-flex font-medium text-sm" href="https://github.com/helloideabox/smart-docs/issues">
					Raise a Ticket
				</ExternalLink>
			</CardFooter>
		</Card>
	);
}

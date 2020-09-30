import {
	TabPanel,
	Card,
	CardBody,
	CardHeader,
	CardFooter,
	ExternalLink,
} from "@wordpress/components";

export default function SidePanel() {
	return (
		<Card isElevated="true" className="smart-docs-side-card col-span-1 m-5 h-fit-content">
			<CardHeader className="smart-docs-card-header font-bold text-xl pl-5 pt-4 pb-3">Help/Support</CardHeader>
			<CardBody>
				Found a issue? or Have a suggestion? <br />
				<br />
				We use Github to track issues and suggestions. Click the link below to
				go to our Github Page and post issue/suggestion.
			</CardBody>
			<CardFooter className="smart-docs-card-footer pt-4 pb-4">
				<ExternalLink className="w-full inline-flex font-medium text-base" href="https://github.com/helloideabox/smart-docs/issues">
					Raise a Ticket
				</ExternalLink>
			</CardFooter>
		</Card>
	);
}

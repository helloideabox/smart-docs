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
		<Card isElevated="true" className="col-span-1 m-5 h-64">
			<CardHeader className="font-bold text-xl">Help/Support</CardHeader>
			<CardBody>
				Found a issue? or Have a suggestion? <br />
				<br />
				We use Github to track issues and suggestions. Click the link below to
				go to our Github Page and post issue/suggestion.
			</CardBody>
			<CardFooter>
				<ExternalLink href="https://github.com/helloideabox/easy-docs/issues">
					Raise a Ticket
				</ExternalLink>
			</CardFooter>
		</Card>
	);
}

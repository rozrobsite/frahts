function blockElement(object) {
	object.block({
		message: '<img src="/images/elements/loaders/10s.gif" />',
		css: {
			border: '0',
			backgroundColor: 'transparent'
		},
		overlayCSS: {
			backgroundColor: '#F7F7F7',
			opacity: .8
		}
	});
}

function unblockElement(object) {
	object.unblock();
}
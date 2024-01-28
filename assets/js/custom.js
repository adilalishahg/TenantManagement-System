function notification(
	message,
	duration = 2000,
	close = true,
	gravity = "top",
	position = "center",
	backgroundColor = "linear-gradient(to right, #ff416c,#ff4b2b)"
) {
	Toastify({
		text: message,
		duration: duration,
		close: close,
		gravity: gravity,
		position: position,
		backgroundColor: backgroundColor,
	}).showToast();
}

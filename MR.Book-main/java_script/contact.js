function sendEmail() {
	const subject = document.getElementById('subject').value;
	const body = document.getElementById('body').value;
	const email = "someone@gmail.com";

	// Build mailto link and open it
	const mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
	window.location.href = mailtoLink;
}

fetch('../html/footer.html')    // Load the footer dynamically
	.then(response => response.text())
	.then(data => {
		document.querySelector("footer").innerHTML = data;
});

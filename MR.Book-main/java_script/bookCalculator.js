function addBook() {
	const container = document.getElementById('bookEntries');
	const div = document.createElement('div');
	div.className = 'book-entry';
	div.innerHTML = `
		<input type="text" name="titles[]" placeholder="שם הספר" required>
		<input type="number" name="prices[]" placeholder="מחיר" required>
		<input type="number" name="quantities[]" placeholder="כמות" required>
		<button type="button" class="remove-btn" onclick="removeBook(this)">הסר</button>`;
	container.appendChild(div);
}

function removeBook(button) {
	const entry = button.parentElement;
	const container = document.getElementById('bookEntries');
	if (container.children.length > 1) {
		container.removeChild(entry);
	} else {
		alert("חובה להשאיר לפחות רשומה אחת");
	}
}

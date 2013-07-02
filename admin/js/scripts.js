function file_enable() {
	if(document.form.file.disabled == true) {
		document.form.file.disabled = false;
	}
	else {
		document.form.file.disabled = true;
	}
}
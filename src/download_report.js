function download(data) {
	let date = new Date();
	date = date.toISOString();
	const fileName = 'report' + date + '.xlsx';
	let workbook = XLSX.utils.book_new(),
		worksheet = XLSX.utils.aoa_to_sheet(data);
	workbook.SheetNames.push('First');
	workbook.Sheets['First'] = worksheet;
	XLSX.writeFile(workbook, fileName);
	let xlsblob = new Blob(
		[new Uint8Array(XLSX.write(workbook, {
			bookType: 'xlsx',
			type: 'array'
		}))], {
		type: 'application/octet-stream'
	}
	);

	// формируем данные
	let formData = new FormData();
	formData.append('xls', xlsblob, fileName);

	// отправляем на сервер
	fetch('reports.php', {
		method: 'POST',
		body: formData
	})
		.then(res => res.text())
}
export default class Behaviour {
	static confirmWithDialogAndReset(form, response) {
		form.stopProcessingAjaxCall();
		form.reset();

		Behaviour.confirm(form, response);
	}

	static confirmWithDialogAndClear(form, response) {
		form.stopProcessingAjaxCall();
		form.clear();

		Behaviour.confirm(form, response);
	}

	static confirm(form, response) {
		scEvent.emit('topAlert', {
			id: form.group,
			style: response.data.style || 'success',
			message: response.data.message
		});
	}

	static redirect(form, response) {
		window.location.href = response.data.url;
	}

	static reload(form, response) {
		window.location.reload(true);
	}

	static sleep(form, response) {
		form.stopProcessingAjaxCall();
	}
}

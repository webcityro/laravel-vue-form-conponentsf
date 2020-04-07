export default class ErrorHandler {
	static showError(error, beforeCallback = null) {
		if (typeof beforeCallback === 'function') {
			beforeCallback();
		}

		if (error.response && error.response.data) {
			ErrorHandler.errorDialog(error.response.message);
			return;
		}

		if (error.message) {
			ErrorHandler.errorDialog(error.message);
			return;
		}

		console.log({ errorHandler: error });
	}

	static errorDialog(message, id = 'request-failure') {
		scEvent.emit('topAlert', {
			id,
			message,
			style: 'danger'
		});
	}
}

import Rule from './Rule';

export default class Validator {
	constructor(wrapper, resolve, reject) {
		this.fields = wrapper.fields;
		this.validationBag = wrapper.validationBag;
		this.errors = {};

		Promise.all(this.promises())
			.then(resolve)
			.catch(error => {
				wrapper.error.set(this.errors);
				reject({ message: error });
			});
	}

	promises() {
		const promises = [];

		for (let field in this.validationBag) {
			promises.push(this.validate(field));
		}

		return promises;
	}

	validate(field) {
		return new Promise((resolve, reject) => {
			const rules = this.validationBag[field];
			const rulesCount = rules.length;
			const value = this.getValue(field);

			for (const key in rules) {
				if (!this.errors.hasOwnProperty(field)) {
					const [rule, params] = rules[key].split(':');

					try {
						if (!Rule[rule](value, params)) {
							this.errors[field] = rule;
							reject('Your input was invalid.');
						}
					} catch (error) {
						reject(
							'Invalid form validation rule: ' +
								rule +
								' at field ' +
								field
						);
					}
				}

				if (parseInt(key) + 1 === rulesCount) {
					resolve();
				}
			}
		});
	}

	getValue(field) {
		return field.split('.').reduce((accumulator, current) => {
			return accumulator[current];
		}, this.fields);
	}
}

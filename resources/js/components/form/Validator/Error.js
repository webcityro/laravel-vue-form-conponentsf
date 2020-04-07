export default class Error {
    constructor() {
        this.clear();
    }

    set(errors) {
        this.errors = errors;
    }

    all() {
        return this.errors;
    }

    clear() {
        this.errors = {};
    }

    has(field, rule = false) {
        const fieldExists = this.errors.hasOwnProperty(field);

        if (!rule) {
            return fieldExists;
        }

        return fieldExists && this.errors[field] === rule;
    }
}

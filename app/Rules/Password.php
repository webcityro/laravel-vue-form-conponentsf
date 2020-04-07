<?php

namespace FC\Rules;

use FC\Components\Validation\RuleContract;

class Password implements RuleContract {

	const PATTERN = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{6,30}$/';

	public function passes($attribute, $value): bool {
		return preg_match(self::PATTERN, $value) === 1;
	}

	public function message(): string {
		return 'Invalid password format';
	}

	public function rule(): string {
		return 'password';
	}
}

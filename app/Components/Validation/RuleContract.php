<?php

namespace FC\Components\Validation;

use Illuminate\Contracts\Validation\Rule;

interface RuleContract extends Rule {
    public function rule(): string;
}

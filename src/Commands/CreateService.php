<?php

namespace Singlephon\Corelink\Commands;

use Illuminate\Support\Str;

class CreateService extends StubMaker
{
    protected string $belongs = 'Services';

    public function __construct(string $name)
    {
        parent::__construct('CoreLink', 'Services', 'createserviceable.stub');
        if (Str::contains($name, 'Service')) $name = '';
        $this->name = $name;
    }

    public function replacements(): array
    {
        return [
            '{{ name }}' => $this->name,
            '{{ namespace }}' => 'App\\CoreLink\\Services'
        ];
    }
}

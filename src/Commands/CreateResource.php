<?php

namespace Singlephon\Corelink\Commands;

class CreateResource extends StubMaker
{
    protected string $belongs = 'ServiceResource';

    public function __construct($name)
    {
        parent::__construct('CoreLink', 'Resources', 'serviceresource.stub');
        $this->name = $name;
    }

    public function replacements(): array
    {
        return [
            '{{ name }}' => $this->name,
            '{{ namespace }}' => 'App\\CoreLink\\Resources'
        ];
    }
}

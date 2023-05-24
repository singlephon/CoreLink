<?php

namespace Singlephon\Corelink\Commands;

class CreateSyncable extends StubMaker
{
    protected string $belongs = 'Syncable';

    public function __construct(string $name)
    {
        parent::__construct('CoreLink', 'Sync', 'createsyncable.stub');
        $this->name = $name;
    }

    public function replacements(): array
    {
        return [
            '{{ name }}' => $this->name,
            '{{ namespace }}' => 'App\\CoreLink\\Sync'
        ];
    }
}

<?php

namespace Singlephon\Corelink\Commands;

use Illuminate\Support\Facades\File;

abstract class StubMaker extends File
{
    /**
     * Module path located in App directory
     * @var $modulePath string
     */
    private string $modulePath;
    protected string $stub;

    protected string $name;

    protected string $belongs = '';

    public function __construct (string $module, string $folder, string $stub)
    {
        $this->setModulePath($module . '/' . $folder . '/');
        $this->stub = __DIR__ . '/../../stubs/' . $stub;
    }

    /**
     * Set Module path
     * @param string $module
     */
    public function setModulePath(string $module): void
    {
        $this->modulePath = app_path($module);
    }

    public function make(string $name = null): void
    {
        $name = $name ?? $this->name;
        $stubContents = File::get($this->stub);
        $destinationFile = $this->modulePath . $name . $this->belongs . '.php';
        $stubContents = strtr($stubContents, $this->replacements());
        if (File::exists($destinationFile)) return;
        File::put($destinationFile, $stubContents);
    }

    abstract public function replacements (): array;

}

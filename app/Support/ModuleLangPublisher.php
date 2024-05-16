<?php

namespace App\Support;

use Nwidart\Modules\Publishing\Publisher;
use Nwidart\Modules\Support\Config\GenerateConfigReader;

class ModuleLangPublisher extends Publisher
{
    /**
     * Determine whether the result message will shown in the console.
     *
     * @var bool
     */
    protected $showMessage = false;

    /**
     * Get destination path.
     *
     * @return string
     */
    public function getDestinationPath()
    {
        $name = $this->module->getLowerName();

        return base_path("lang/");
    }

    /**
     * Get source path.
     *
     * @return string
     */
    public function getSourcePath()
    {
        return $this->getModule()->getExtraPath(
            GenerateConfigReader::read('lang')->getPath()
        );
    }
}

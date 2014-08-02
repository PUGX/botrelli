<?php

namespace PUGX\Bot\Step;

use PUGX\Bot\LocalPackage;
use Symfony\Component\Process\Process;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ExecuteCSFixer extends DispatcherStep
{
    const DEFAULT_TIMEOUT = 3600;

    /**
     * Path to php-cs-fixer
     *
     * @var string $csFixerBin
     */
    private $csFixerBin;

    /**
     * The process timeout.
     *
     * @var int
     */
    private $timeout;

    public function __construct($csFixerBin, $timeout = self::DEFAULT_TIMEOUT, EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher);
        if (!is_executable($csFixerBin)) {
            throw new \InvalidArgumentException(sprintf('%s is not executable!', $csFixerBin));
        }

        $this->csFixerBin = $csFixerBin;
        $this->timeout    = $timeout;
    }

    /**
     * @param  LocalPackage $package
     * @return int
     */
    public function execute(LocalPackage $package)
    {
        $process = $this->phpCsProcess($package);

        return $process->run();
    }

    /**
     * @param LocalPackage $package
     * @param array        $options
     *
     * @return Process
     */
    private function phpCsProcess(LocalPackage $package, array $options = array())
    {
        return new Process($this->csFixerBin . $this->createInputString($package, $options) , null, null, null, $this->timeout);
    }

    /**
     * @param LocalPackage $package
     * @param array        $options
     *
     * @return string
     */
    private function createInputString(LocalPackage $package, array $options = array())
    {
        return sprintf(" fix %s %s", $package->getFolder(), $this->transformOptionsToString($options));
    }

    /**
     * @param array $options
     *
     * @return string
     */
    private function transformOptionsToString(array $options)
    {
        $stringedOptions = '';
        foreach ($options as $optionName => $optionValue) {

            $stringedOptions .= is_null($optionValue) ? $optionName : sprintf("%s=%s", $optionName, $optionValue);
        }

        return $stringedOptions;
    }
}

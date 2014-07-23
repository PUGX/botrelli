<?php

namespace PUGX\Bot;

use Packagist\Api\Result\Package as BasePackage;

class Package extends BasePackage
{
    /**
     * @return mixed
     */
    public function getUsername()
    {
        $sp = $this->splitName();
        return $sp[0];
    }

    /**
     * @return mixed
     */
    public function getRepoName()
    {
        $sp = $this->splitName();
        return $sp[1];
    }

    /**
     * @return array
     */
    private function splitName()
    {
        return explode("/", $this->getName());
    }
} 
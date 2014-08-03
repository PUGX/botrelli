<?php

namespace PUGX\Bot;

use Packagist\Api\Result\Package as APIPackage;

class Package extends APIPackage
{
    public static function createFromAPIPackage(APIPackage $package)
    {
        $input = array('name' => $package->name,
        'description' => $package->description,
        'time' => $package->time,
        'maintainers' => $package->maintainers,
        'versions' => $package->versions,
        'type' => $package->type,
        'repository' => $package->repository,
        'downloads' => $package->downloads,
        'favers' => $package->favers
        );

        $package = new self();
        $package->fromArray($input);

        return $package;
    }

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

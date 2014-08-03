<?php

namespace PUGX\Bot;

use Packagist\Api\Result\Package as APIPackage;

class Package extends APIPackage
{
    protected $id;
    protected $visited;
    protected $lastVisited;
    protected $blacklisted;

    public static function createFromAPIPackage(APIPackage $package)
    {
        $input = array(
            'name' => $package->name,
            'visited' => false,
            'blacklisted' => false
        );

        $package = new self();
        $package->fromArray($input);

        return $package;
    }

    /**
     * @param $packageName
     * @return Package
     */
    public static function create($packageName)
    {
        $package = new self();
        $package->fromArray(array(
            'name' => $packageName,
            'visited' => false,
            'blacklisted' => false
        ));

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

    /**
     * @return boolean
     */
    public function getVisited()
    {
        return $this->visited;
    }

    /**
     * @return boolean
     */
    public function getBlacklisted()
    {
        return $this->blacklisted;
    }

    /**
     * @return mixed
     */
    public function getLastVisited()
    {
        return $this->lastVisited;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}

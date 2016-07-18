<?php

namespace PHPCI\Plugin;

use PHPCI\Builder;
use PHPCI\BuildFactory;
use PHPCI\Model\Build;
use PHPCI\Model\Project;

/**
 * Class QFramework
 *
 * @package PHPCI\Plugin
 */
class QFramework implements \PHPCI\Plugin
{
    private $phpci;
    private $build;
    private $options;

    public function __construct(Builder $phpci, Build $build, array $options = array())
    {
        $this->phpci = $phpci;
        $this->build = $build;
        $this->options = $options;
    }

    public function execute()
    {
        $build = BuildFactory::getBuildById($this->options['buildId']);

        if (!$build) {
            $this->phpci->logFailure('QFramework not found');
        }

        if (!$build instanceof Build\RemoteGitBuild) {
            $this->phpci->logFailure('');
        }

        $build->createWorkingCopy($this->phpci, $this->phpci->buildPath.DIRECTORY_SEPARATOR.'system');
    }
}
<?php

/*
 * This file is the core of Symfony.
 *
 * (c) Sfari Rami <rami2sfari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
      $contents = require sprintf('%s/config/bundles.php', $this->getRootDir());
      foreach ($contents as $class => $envs) {
          if (isset($envs['all']) || isset($envs[$this->environment])) {
              yield new $class();
          }
      }
    }

    public function getRootDir()
    {
        return dirname(__DIR__);
    }

    public function getCacheDir()
    {
        return sprintf('%s/var/cache/%s', $this->getRootDir(), $this->getEnvironment());
    }

    public function getLogDir()
    {
        return sprintf('%s/var/logs', $this->getRootDir());
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->setParameter('container.autowiring.strict_mode', true);
            $container->setParameter('container.dumper.inline_class_loader', true);

            $container->addObjectResource($this);
        });
        $loader->load(sprintf('%s/config/config_%s.yml', $this->getRootDir(), $this->getEnvironment()));
    }
}

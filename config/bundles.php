<?php

/*
 * This file is part of Symfony core (Kernel).
 *
 * (c) Sfari Rami <rami2sfari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
  // all environment
  Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
  Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
  Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
  Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
  Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle::class => ['all' => true],
  Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
  Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle::class => ['all' => true],
  FOS\UserBundle\FOSUserBundle::class => ['all' => true],
  Spraed\PDFGeneratorBundle\SpraedPDFGeneratorBundle::class => ['all' => true],
  Sg\DatatablesBundle\SgDatatablesBundle::class => ['all' => true],
  Knp\Bundle\PaginatorBundle\KnpPaginatorBundle::class => ['all' => true],
  ServiceBundle\ServiceBundle::class => ['all' => true],
  DatatablesBundle\DatatablesBundle::class => ['all' => true],
  Http\HttplugBundle\HttplugBundle::class => ['all' => true],
  Knp\Bundle\SnappyBundle\KnpSnappyBundle::class => ['all' => true],
  // HWI\Bundle\OAuthBundle\HWIOAuthBundle::class => ['all' => true],
  Vich\UploaderBundle\VichUploaderBundle::class => ['all' => true],
  Liip\ImagineBundle\LiipImagineBundle::class => ['all' => true],
  JMS\TranslationBundle\JMSTranslationBundle::class => ['all' => true],
  // Dev Environment
  Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle::class => ['dev' => true],
  Symfony\Bundle\WebServerBundle\WebServerBundle::class => ['dev' => true],
  // Dev and test environment
  Symfony\Bundle\DebugBundle\DebugBundle::class => ['dev' => true, 'test' => true],
  Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
  Sensio\Bundle\DistributionBundle\SensioDistributionBundle::class => ['dev' => true, 'test' => true],
];

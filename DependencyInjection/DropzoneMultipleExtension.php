<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace yassinehamouten\UX\DropzoneMultiple\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use yassinehamouten\UX\DropzoneMultiple\Form\DropzoneMultipleType;

/**
 * @author Yassine Hamouten <yassinehamouten@gmail.com>
 * @author Titouan Galopin <galopintitouan@gmail.com>
 *
 * @internal
 */
class DropzoneMultipleExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
        // Register the Dropzone form theme if TwigBundle is available
        $bundles = $container->getParameter('kernel.bundles');

        if (!isset($bundles['TwigBundle'])) {
            return;
        }

        $container->prependExtensionConfig('twig', ['form_themes' => ['@DropzoneMultiple/form_theme.html.twig']]);
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->setDefinition('form.dropzonemultiple', new Definition(DropzoneMultipleType::class))
            ->addTag('form.type')
            ->setPublic(false)
        ;
    }
}

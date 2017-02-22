<?php
namespace Mapbender\LdapBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class MapbenderLdapExtension
 *
 * @package FOM\UserBundle\DependencyInjection
 */
class MapbenderLdapExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('security.xml');
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'mapbender_ldap';
    }
}

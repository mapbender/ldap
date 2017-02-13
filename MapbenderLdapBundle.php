<?php

namespace Mapbender\LdapBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Mapbender\LdapBundle\DependencyInjection\Factory\LdapSecurityFactory;
use FOM\ManagerBundle\Component\ManagerBundle;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

/**
 * FOMUserBundle - provides user management
 *
 * @author Christian Wygoda
 */
class MapbenderLdapBundle extends ManagerBundle
{
    public function build(ContainerBuilder $container)
    {
        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new LdapSecurityFactory());
    }
}

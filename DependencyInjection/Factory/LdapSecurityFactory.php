<?php
namespace Mapbender\LdapBundle\DependencyInjection\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

class LdapSecurityFactory extends FormLoginFactory
{
    public function getKey()
    {
        return 'ldap-login';
    }

    protected function getListenerId()
    {
        return 'security.authentication.listener.form';
    }

    protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $provider = 'fom.ldap.authentication_provider.'.$id;
        $container
            ->setDefinition($provider, new DefinitionDecorator('fom.ldap.authentication_provider'))
            ->replaceArgument(1, new Reference($userProviderId))
            ->replaceArgument(3, $id)
        ;

        return $provider;
    }
}

<?php
namespace Mapbender\LdapBundle\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

class LdapFactory extends FormLoginFactory
{
    protected function getListenerId()
    {
        return 'security.authentication.listener.form';
    }

    public function getKey()
    {
        return 'fom_ldap';
    }

     protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $provider = 'fom_ldap.security.authentication.provider';
        $providerId = $provider . '.' . $id;

        $container
            ->setDefinition($providerId, new DefinitionDecorator($provider))
            ->replaceArgument(1, $id) // Provider Key
            ->replaceArgument(0, new Reference($userProviderId)) // User Provider
        ;

        return $providerId;
    }
}

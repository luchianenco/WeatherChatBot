<?php

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\Service\BotClientService;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class BotClientPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(BotClientService::class)) {
            return;
        }

        $definition = $container->findDefinition(BotClientService::class);
        $taggedServices = $container->findTaggedServiceIds('bot.client');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addBotClient',
                    array(new Reference($id), $attributes["alias"])
                );
            }
        }
    }
}

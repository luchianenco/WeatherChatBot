<?php

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\Factory\FacebookBotRequestFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class BotRequestStrategyPass implements CompilerPassInterface
{
    const TAG_ID = 'bot.request.strategy.facebook';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(FacebookBotRequestFactory::class)) {
            return;
        }

        $definition = $container->findDefinition(FacebookBotRequestFactory::class);
        $taggedServices = $container->findTaggedServiceIds(self::TAG_ID);

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addStrategy',
                    array(new Reference($id), $attributes["order"])
                );
            }
        }
    }
}

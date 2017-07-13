<?php

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\Factory\FacebookBotRequestFactory;
use AppBundle\Processor\WeatherProcessor\RequestTypeStrategy\PostbackRequestType;
use AppBundle\Processor\WeatherProcessor\WeatherProcessor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class WeatherPostbackStatePass implements CompilerPassInterface
{
    const TAG_ID = 'bot.state.postback.weather.strategy';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(PostbackRequestType::class)) {
            return;
        }

        $definition = $container->findDefinition(PostbackRequestType::class);
        $taggedServices = $container->findTaggedServiceIds(self::TAG_ID);

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addState', [new Reference($id)]);
            }
        }
    }
}

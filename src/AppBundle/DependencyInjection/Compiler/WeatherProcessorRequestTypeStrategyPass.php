<?php

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\Factory\FacebookBotRequestFactory;
use AppBundle\Processor\WeatherProcessor\WeatherProcessor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class WeatherProcessorRequestTypeStrategyPass implements CompilerPassInterface
{
    const TAG_ID = 'bot.processor.weather.strategy';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(WeatherProcessor::class)) {
            return;
        }

        $definition = $container->findDefinition(FacebookBotRequestFactory::class);
        $taggedServices = $container->findTaggedServiceIds(self::TAG_ID);

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addStrategy', [new Reference($id)]);
            }
        }
    }
}

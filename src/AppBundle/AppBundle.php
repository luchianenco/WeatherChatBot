<?php

namespace AppBundle;

use AppBundle\DependencyInjection\Compiler\BotClientPass;
use AppBundle\DependencyInjection\Compiler\BotRequestStrategyPass;
use AppBundle\DependencyInjection\Compiler\WeatherProcessorRequestTypeStrategyPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new BotClientPass());
        $container->addCompilerPass(new BotRequestStrategyPass());
        $container->addCompilerPass(new WeatherProcessorRequestTypeStrategyPass());
    }
}

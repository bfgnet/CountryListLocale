<?php

return array(
    'router' => array(
        'routes' => array(
            'countryList' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/countrylist',
                    'defaults' => array(
                        '__NAMESPACE__' => 'CountryListLocale\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action][/:locale]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'regionList' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/regionlist',
                    'defaults' => array(
                        '__NAMESPACE__' => 'CountryListLocale\Controller',
                        'controller' => 'Region',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action][/:countrycode]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'CountryListLocale\Controller\Index' => 'CountryListLocale\Controller\IndexController',
            'CountryListLocale\Controller\Region' => 'CountryListLocale\Controller\RegionController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'countrylistlocale' => __DIR__ . '/../view',
        ),
    ),
);

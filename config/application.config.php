<?php
return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Application',
        'Album',
        'KpBase',
        'KpUser',

    ),

    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => array(
        // 告诉mvc我的模块在哪2个文件夹下
        // 通过 Zend\ModuleManager\Listener\ModuleLoaderListener 去注册moduleAutoloader
        'module_paths' => array(
            './module',
            './vendor',
        ),

        // 通过 Zend\ModuleManager\Listener\ConfigListener 加载这些配置
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),

    ),


);

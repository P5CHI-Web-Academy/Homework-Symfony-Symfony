<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerHPDIHhC\srcDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerHPDIHhC/srcDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerHPDIHhC.legacy');

    return;
}

if (!\class_exists(srcDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerHPDIHhC\srcDevDebugProjectContainer::class, srcDevDebugProjectContainer::class, false);
}

return new \ContainerHPDIHhC\srcDevDebugProjectContainer(array(
    'container.build_hash' => 'HPDIHhC',
    'container.build_id' => 'fa79a79d',
    'container.build_time' => 1524436503,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerHPDIHhC');

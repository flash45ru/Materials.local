<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $zavhoz = $auth->createRole('zavhoz');
        $worker = $auth->createRole('worker');

        // запишем их в БД
        $auth->add($admin);
        $auth->add($zavhoz);
        $auth->add($worker);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateMaterials = $auth->createPermission('updateMaterials');
        $updateMaterials->description = 'Редактирование материалов';

        $addMaterials = $auth->createPermission('addMaterials');
        $addMaterials->description = 'Добавление материалов';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($updateMaterials);
        $auth->add($addMaterials);

        // Теперь добавим наследования. Для роли zavhoz мы добавим разрешение updateMaterials,
        // а для админа добавим наследование от роли zavhoz и еще добавим собственное разрешение viewAdminPage

        // Роли «Завхоза» присваиваем разрешение «Редактирование материалов»
        $auth->addChild($zavhoz,$updateMaterials);

        // Роли «Рабочего» присваиваем разрешение «Добавление материалов»
        $auth->addChild($worker,$addMaterials);

        // «Завхоза» наследует роль «Рабочего». Он же тоже рабочий)
        $auth->addChild($zavhoz, $worker);

        // админ наследует роль редактора материалов. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $zavhoz);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);

        // Назначаем роль «Завхоза» пользователю с ID 2
        $auth->assign($zavhoz, 2);

        // Назначаем роль «Рабочего» пользователю с ID 3
        $auth->assign($worker, 3);
    }
}
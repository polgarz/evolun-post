<?php

use yii\db\Migration;

/**
 * Class m190222_133402_rbac_add_post_permissions
 */
class m190222_133402_rbac_add_post_permissions extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $managePosts = $auth->createPermission('managePosts');
        $managePosts->description = 'Bejegyzések szerkesztése';
        $auth->add($managePosts);

        $showPosts = $auth->createPermission('showPosts');
        $showPosts->description = 'Bejegyzések megtekintése';
        $auth->add($showPosts);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $showPosts);
        $auth->addChild($admin, $managePosts);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $managePosts = $auth->getPermission('managePosts');
        $auth->remove($managePosts);

        $showPosts = $auth->getPermission('showPosts');
        $auth->remove($showPosts);
    }
}

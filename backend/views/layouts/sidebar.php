<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link text-center">
        <img src="/images/logo.png" alt="I-LEARNING Logo" class="w-75" style="opacity: .8;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
                    ['label' => Yii::t('app', 'Пәндер'), 'icon' => 'book', 'url' => ['/course']],
                    ['label' => Yii::t('app', 'Сабақтар'), 'icon' => 'book-open', 'url' => ['/section']],
                    ['label' => Yii::t('app','Квиздер'), 'icon' => 'file','url' => ['/test']],
                    ['label' => Yii::t('app','Оқу-әдістеме'), 'icon' => 'file-pdf','url' => ['/section-file']],
                    ['label' => Yii::t('app','Сөздік'), 'icon' => 'language','url' => ['/section-dictionary']],
                    ['label' => Yii::t('app','Практикалық жұмыс'), 'icon' => 'tasks','url' => ['/section-practical-work']],
                    ['label' => Yii::t('app', 'Мұғалімдер'), 'icon' => 'users', 'url' => ['/teacher']],
                    ['label' => Yii::t('app', 'Мәтіндер'), 'icon' => 'file-alt', 'url' => ['/info']],
                    ['label' => Yii::t('app', 'Пікірлер'), 'icon' => 'comment', 'url' => ['/review']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apostila $apostila
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Lista de Apostilas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="apostilas form content">
            <?= $this->Form->create($apostila, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Nova Apostila') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nome da Apostila']);
                    echo $this->Form->control('nivel', [
                        'label' => 'Dificuldade',
                        'type' => 'select',
                        'options' => [
                            'iniciante' => 'Iniciante',
                            'intermediario' => 'Intermediário',
                            'avancado' => 'Avançado'
                        ]
                    ]);
                    echo $this->Form->control('arquivo', ['label' => 'Arquivo (PDF)', 'type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Confirmar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

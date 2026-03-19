<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sesso $sesso
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $apostilas
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Lista de Sessões'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sessoes form content">
            <?= $this->Form->create($sesso) ?>
            <fieldset>
                <legend><?= __('Nova Sessão') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nome da Sessão']);
                    echo $this->Form->control('apostila_id', ['options' => $apostilas, 'empty' => true]);
                    echo $this->Form->control('sessao_date', ['label' => 'Data'] , ['empty' => true]);
                    echo $this->Form->control('start_time', ['label' => 'Hora Inicial'], ['empty' => true]);
                    echo $this->Form->control('end_time', ['label' => 'Hora Final'], ['empty' => true]);
                    echo $this->Form->control('conteudo', ['label' => 'Conteúdo']);
                    echo $this->Form->control('objetivo', ['label' => 'Objetivo']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Confirmar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

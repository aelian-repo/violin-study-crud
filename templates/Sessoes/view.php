<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sesso $sesso
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Editar Sessão'), ['action' => 'edit', $sesso->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Deletar Sessão'), ['action' => 'delete', $sesso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sesso->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista de Sessões'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nova Sessão'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sessoes view content">
            <h3><?= h($sesso->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome da Sessão') ?></th>
                    <td><?= h($sesso->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Apostila') ?></th>
                    <td><?= $sesso->has('apostila') ? $this->Html->link($sesso->apostila->name, ['controller' => 'Apostilas', 'action' => 'view', $sesso->apostila->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Criado em') ?></th>
                    <td><?= h($sesso->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data') ?></th>
                    <td><?= h($sesso->sessao_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora Inicial') ?></th>
                    <td><?= h($sesso->start_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora Final') ?></th>
                    <td><?= h($sesso->end_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Duração') ?></th>
                    <td><?= $sesso->duracao ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Conteúdo') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($sesso->conteudo)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Objetivo') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($sesso->objetivo)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

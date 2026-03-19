<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sesso> $sessoes
 */
?>
<div class="sessoes index content">
    <?= $this->Html->link(__('Criar Sessão'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sessões') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('apostila_id') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>   
                    <th><?= $this->Paginator->sort('Data') ?></th>
                    <th><?= $this->Paginator->sort('Hora Inicial') ?></th>
                    <th><?= $this->Paginator->sort('Hora Final') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sessoes as $sesso): ?>
                <tr>
                    <td><?= $this->Number->format($sesso->id) ?></td>
                    
                    <td><?= $sesso->has('apostila') ? $this->Html->link($sesso->apostila->name, ['controller' => 'Apostilas', 'action' => 'view', $sesso->apostila->id]) : '' ?></td>
                    <td><?= h($sesso->name) ?></td>
                    <td><?= h($sesso->sessao_date) ?></td>
                    <td><?= h($sesso->start_time) ?></td>
                    <td><?= h($sesso->end_time) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $sesso->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $sesso->id]) ?>
                        <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $sesso->id], ['confirm' => __('Deletar {0}?', $sesso->name)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

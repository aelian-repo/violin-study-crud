<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Apostila> $apostilas
 */
?>
<div class="apostilas index content">
    <?= $this->Html->link(__('Criar Apostila'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Apostilas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th><?= $this->Paginator->sort('dificuldade') ?></th>
                    <th><?= $this->Paginator->sort('arquivo') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($apostilas as $apostila): ?>
                <tr>
                    <td><?= $this->Number->format($apostila->id) ?></td>
                    <td><?= h($apostila->name) ?></td>
                    <td><?= h($apostila->nivel) ?></td>
                    <td><?= $this->Html->link(
                        $apostila->arquivo,
                        '/uploads/apostilas/' . $apostila->arquivo,
                        ['target' => '_blank']
                    ) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $apostila->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $apostila->id]) ?>
                        <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $apostila->id], ['confirm' => __('Deletar {0}?', $apostila->name)]) ?>
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

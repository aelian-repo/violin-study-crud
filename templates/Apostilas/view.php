<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apostila $apostila
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Editar Apostila'), ['action' => 'edit', $apostila->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Deletar Apostila'), ['action' => 'delete', $apostila->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apostila->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista de Apostilas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nova Apostila'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="apostilas view content">
            <h3><?= h($apostila->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome da Apostila') ?></th>
                    <td><?= h($apostila->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nivel') ?></th>
                    <td><?= h($apostila->nivel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Arquivo') ?></th>
                    <td><?= $this->Html->link(
                        $apostila->arquivo,
                        '/uploads/apostilas/' . $apostila->arquivo,
                        ['target' => '_blank']
                    ) ?></td>
                </tr>
                <tr>
                    <th><?= __('Criado em') ?></th>
                    <td><?= h($apostila->created) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Sessões Relacionadas') ?></h4>
                <?php if (!empty($apostila->sessoes)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Apostila Id') ?></th>
                            <th><?= __('Nome') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Hora Inicial') ?></th>
                            <th><?= __('Hora Final') ?></th>
                            <th class="actions"><?= __('Ações') ?></th>
                        </tr>
                        <?php foreach ($apostila->sessoes as $sessoes) : ?>
                        <tr>
                            <td><?= h($sessoes->id) ?></td>
                            <td><?= h($sessoes->apostila_id) ?></td>
                            <td><?= h($sessoes->name) ?></td>
                            <td><?= h($sessoes->sessao_date) ?></td>
                            <td><?= h($sessoes->start_time) ?></td>
                            <td><?= h($sessoes->end_time) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Sessoes', 'action' => 'view', $sessoes->id]) ?>
                                <?= $this->Html->link(__('Editar'), ['controller' => 'Sessoes', 'action' => 'edit', $sessoes->id]) ?>
                                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Sessoes', 'action' => 'delete', $sessoes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sessoes->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

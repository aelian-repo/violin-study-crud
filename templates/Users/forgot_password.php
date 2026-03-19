<h1>Esqueci a senha</h1>

<?= $this->Flash->render() ?>

<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('new_password', ['type' => 'password']) ?>
<?= $this->Form->button('Redefinir senha') ?>
<?= $this->Form->end() ?>
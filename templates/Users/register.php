<h1>Cadastro</h1>

<?= $this->Flash->render() ?>

<?= $this->Form->create() ?>
<?= $this->Form->control('name') ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Cadastrar') ?>
<?= $this->Form->end() ?>

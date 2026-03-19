<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Apostilas Controller
 *
 * @property \App\Model\Table\ApostilasTable $Apostilas
 * @method \App\Model\Entity\Apostila[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApostilasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $userId = $this->request->getAttribute('identity')->getIdentifier();

        $query = $this->Apostilas->find()
            ->where(['Apostilas.user_id' => $userId]);
        
        $apostilas = $this->paginate($query);
        $this->set(compact('apostilas'));
    }

    /**
     * View method
     *
     * @param string|null $id Apostila id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $apostila = $this->Apostilas->get($id, [
            'contain' => ['Users', 'Sessoes'],
        ]);

        $this->Authorization->authorize($apostila);

        $this->set(compact('apostila'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $apostila = $this->Apostilas->newEmptyEntity();

        $this->Authorization->authorize($apostila);

        if ($this->request->is('post')) {

            $apostila = $this->Apostilas->patchEntity($apostila, $this->request->getData());

            $apostila->user_id = $this->request->getAttribute('identity')->getIdentifier();

            $arquivo = $this->request->getData('arquivo');

            if ($arquivo && $arquivo->getError() === 0) {

                $nomeArquivo = time() . "_" . $arquivo->getClientFilename();

                $destino = WWW_ROOT . 'uploads' . DS . 'apostilas' . DS . $nomeArquivo;

                $arquivo->moveTo($destino);

                $apostila->arquivo = $nomeArquivo;
            }

            if ($this->Apostilas->save($apostila)) {
                $this->Flash->success(__('Apostila salva com sucesso!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar apostila.'));
        }

        $this->set(compact('apostila'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Apostila id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $apostila = $this->Apostilas->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->authorize($apostila);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $apostila = $this->Apostilas->patchEntity($apostila, $this->request->getData());

            if ($this->Apostilas->save($apostila)) {

                $this->Flash->success(__('Apostila atualizada!'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Erro ao atualizar apostila.'));
        }
        
        $this->set(compact('apostila'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Apostila id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $apostila = $this->Apostilas->get($id);

        $this->Authorization->authorize($apostila);

        if ($this->Apostilas->delete($apostila)) {
            $this->Flash->success(__('Apostila deletada!'));
        } else {
            $this->Flash->error(__('Erro ao deletar apostila.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php


namespace Question\Controller;


use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\ViewModel;
use Question\Form\LoginForm;
use Question\Form\UserForm;
use Question\Model\User;
use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;

class UserController extends AbstractActionController
{
    private Adapter $adapter;

    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->adapter = include __DIR__.'/../../adapter/adapter.config.php';
    }


    public function indexAction(): ViewModel
    {
        $form = new UserForm();
        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function registerAction()
    {
        $form = new UserForm();
        $request = $this->getRequest();
        if (! $request->isPost()) {
            return new ViewModel(['form' => $form]);
        }
        $form->setData($request->getPost());
        if (! $form->isValid()) {
            return new ViewModel(['form' => $form]);
        }

        $user = new User($form->getData());
        $tableGateway = new TableGateway('user_table', $this->adapter);
        $tableGateway->insert([
            'user_name' => $user->getUserName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
        $user->setId($tableGateway->getLastInsertValue());

        return $this->redirect()->toRoute('question');
    }


    public function loginAction()
    {
        $authAdapter = new AuthAdapter(
            $this->adapter,
            'user_table',
            'user_name',
            'password'
        );

        $form = new LoginForm();
        $request = $this->getRequest();
        if (! $request->isPost()) {
            return new ViewModel(['form' => $form]);
        }
        $form->setData($request->getPost());
        if (! $form->isValid()) {
            return new ViewModel(['form' => $form]);
        }

        $authAdapter
            ->setIdentity($form->getData()['user_name'])
            ->setCredential($form->getData()['password']);

        $authAdapter->authenticate();

        $this->redirect()->toRoute('question');
    }

}
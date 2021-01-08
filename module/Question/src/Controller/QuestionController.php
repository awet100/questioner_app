<?php


namespace Question\Controller;


use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Question\Form\QuestionForm;
use Question\Model\Question;

class QuestionController extends AbstractActionController
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
        $questions = [];
        $tableGateway = new TableGateway('question_table', $this->adapter);
        foreach ($tableGateway->select() as $item) {
            $question = new Question($item);
            $question->setId($item['id']);
            array_push($questions, $question);
        }

        $form = new QuestionForm();
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel([
                'questions' => $questions,
                'form' => $form
            ]);
        }
        return new ViewModel([
            'questions' => $questions,
            'form' => $form,
            'correction' => $request->getPost()
        ]);
    }

    /**
     * @return ViewModel | Response
     */
    public function AddAction(): ViewModel
    {
        $form = new QuestionForm();
        $request = $this->getRequest();
        if (! $request->isPost()) {
            return new ViewModel(['form' => $form]);
        }
        $form->setData($request->getPost());
        if (! $form->isValid()) {
            return new ViewModel(['form' => $form]);
        }

        $question = new Question($form->getData());
        $tableGateway = new TableGateway('question_table', $this->adapter);
        $tableGateway->insert([
            'question' => $question->getQuestion(),
            'first_choose' => $question->getFirstChoose(),
            'second_choose' => $question->getSecondChoose(),
            'third_choose' => $question->getThirdChoose(),
            'correct_answer' => $question->getCorrectAnswer()
        ]);
        $question->setId($tableGateway->getLastInsertValue());

        return $this->redirect()->toRoute('question');
    }

}
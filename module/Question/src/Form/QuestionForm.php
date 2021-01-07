<?php


namespace Question\Form;


use Laminas\Form\Form;

class QuestionForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('question', $options);

        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
           'name' => 'question',
           'type' => 'text',
           'options' => [
               'label' => 'Question'
           ]
        ]);

        $this->add([
            'name' => 'correct_answer',
            'type' => 'text',
            'options' => [
                'label' => 'Correct Answer'
            ]
        ]);

        $this->add([
            'name' => 'first_choose',
            'type' => 'text',
            'options' => [
                'label' => 'First Choose'
            ]
        ]);

        $this->add([
            'name' => 'second_choose',
            'type' => 'text',
            'options' => [
                'label' => 'Second Choose'
            ]
        ]);

        $this->add([
            'name' => 'third_choose',
            'type' => 'text',
            'options' => [
                'label' => 'Third Choose'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Add',
                'id' => 'submitbutton'
            ]
        ]);

    }
}
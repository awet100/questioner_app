<?php


namespace Question\Form;


use Laminas\Form\Form;

class UserForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');

        $this->add([
           'name' => 'user_name',
           'type' => 'text',
            'options' => [
                'label' => 'User Name',
            ]
        ]);

        $this->add([
            'name' => 'email',
            'type' => 'email',
            'options' => [
                'label' => 'Email',
            ]
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'Password',
            ]
        ]);

        $this->add([
            'name' => 'confirm_password',
            'type' => 'password',
            'options' => [
                'label' => 'Confirm Password',
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Register',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary'
            ]
        ]);
    }
}
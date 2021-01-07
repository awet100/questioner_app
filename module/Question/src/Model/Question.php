<?php


namespace Question\Model;


class Question
{
    private string $question;
    private string $first_choose;
    private string $second_choose;
    private string $third_choose;
    private string $correct_answer;
    private int $id;

    /**
     * Question constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->question = isset($data)? $data['question'] : "";
        $this->first_choose = isset($data)? $data['first_choose'] : "";
        $this->second_choose = isset($data)? $data['second_choose'] : "";
        $this->third_choose = isset($data)? $data['third_choose'] : "";
        $this->correct_answer = isset($data)? $data['correct_answer'] : "";
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getFirstChoose(): string
    {
        return $this->first_choose;
    }

    /**
     * @return string
     */
    public function getSecondChoose(): string
    {
        return $this->second_choose;
    }

    /**
     * @return string
     */
    public function getThirdChoose(): string
    {
        return $this->third_choose;
    }

    /**
     * @return string
     */
    public function getCorrectAnswer(): string
    {
        return $this->correct_answer;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Question
     */
    public function setId(int $id): Question
    {
        $this->id = $id;
        return $this;
    }



}
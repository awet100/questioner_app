<?php


namespace Question\Model;


class User
{
    private string $user_name;
    private string $email;
    private string $password;
    private int $id;

    /**
     * User constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->user_name = isset($data)? $data['user_name']: "";
        $this->email = isset($data)? $data['email']: "";
        $this->password = isset($data)? $data['password']: "";
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



}
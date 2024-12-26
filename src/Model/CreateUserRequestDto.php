<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequestDto
{
    #[Assert\NotBlank(message: 'Full Name is required')]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: 'Full Name should be at least {{ limit }} characters long',
        maxMessage: 'Full Name should be at most {{ limit }} characters long',
    )]
    private ?string $fullName = null;

    #[Assert\NotBlank(message: 'Email is required')]
    #[Assert\Email(message: 'Email provided was not a valid email address')]
    private ?string $email = null;

    #[Assert\NotBlank(message: 'Password is required')]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: 'Password should be at least {{ limit }} characters long',
        maxMessage: 'Password should be at most {{ limit }} characters long',
    )]
    #[Assert\NotCompromisedPassword(message: 'This password has been leaked in a data breach, it must not be used. Please use another password.')]
    private ?string $password = null;

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): CreateUserRequestDto
    {
        $this->fullName = $fullName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): CreateUserRequestDto
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): CreateUserRequestDto
    {
        $this->password = $password;
        return $this;
    }
}
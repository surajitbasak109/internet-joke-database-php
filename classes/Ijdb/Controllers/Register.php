<?php

/**
 * Register Controller Class
 *
 * @package    PHP and MySQL Joke Machine
 * @subpackage Register.php
 * @author     Surajit Basak<surajitbasak109@gmail.com>
 * @copyright  734006 Techcet Blog Pty Ltd
 */

 namespace Ijdb\Controllers;

 use Ninja\DatabaseTable;

/**
 * Class JokeController
 */
class Register
{
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    /**
     * Registration Form Method
     *
     * @return mixed[]
     */
    public function registrationForm()
    {
        return [
            'view' => 'register.html.php',
            'title' => 'Register an account',
        ];
    }

    /**
     * Success Method
     *
     * @return mixed[]
     */
    public function success()
    {
        return [
            'view' => 'registersuccess.html.php',
            'title' => 'Registration successful',
        ];
    }

    /**
     * Register User Method
     *
     * @return void
     */
    public function registerUser()
    {
        $author = $_POST['author'];

        // Assume the data is valid to begin with.
        $valid = true;
        $errors = [];

        // But if any of the fields has been left blank
        // set $valid to false
        if (empty($author['name'])) {
            $valid = false;
            $errors[] = "Name field is required";
        }

        if (empty($author['email'])) {
            $valid = false;
            $errors[] = "Email field is required";
        } else if (filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = "Email address cannot be validated";
        } else {
            // If the email is not blank and valid:
            // convert the email to lowercase.
            $author['email'] = strtolower($author['email']);

            // Search for the lowercase version of $author['email'].
            if ($this->authorsTable->find("email", $author['email'])) {
                $valid = false;
                $errors[] = "The email address is already in use";
            }
        }

        if (empty($author['password'])) {
            $valid = false;
            $errors[] = "Password field is required";
        }

        // If valid is still true, no fields were blank
        // and the data can be added.
        if ($valid) {
            // Hash the password before saving it in the database
            $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);
            $this->authorsTable->save($author);
            header('location: /author/success');
        } else {
            // If the data is not valid, show the form again.
            return [
                'view' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                    'author' => $author
                ],
            ];
        }
    }
}

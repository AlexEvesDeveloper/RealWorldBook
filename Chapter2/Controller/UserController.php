<?php

namespace RealWorldBook\Chapter2\Controller;

use RealWorldBook\Chapter2\Service\Configuration;
use RealWorldBook\Chapter2\Service\CryptHelper;
use RealWorldBook\Chapter2\View\ErrorView;
use RealWorldBook\Chapter2\View\View;

class UserController
{
    public function resetPasswordAction()
    {
        if (!isset($_POST['email'])) {
            return new ErrorView('resetPassword', 'No email specified');
        }

        $db = new \PDO(Configuration::get('DSN'));
        $db->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        $statement = $db->prepare('SELECT * FROM Users WHERE email=:email');
        $statement->bindValue(':email', $_POST['email'], \PDO::PARAM_STR);
        $statement->execute();

        $record = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($record === false) {
            return new ErrorView('resetPassword', 'No user with email ' . $_POST['email']);
        }

        $code = CryptHelper::getConfirmationCode();
        $statement = $db->prepare('UPDATE users SET code=:code WHERE email=:email');
        $statement->bindValue(':code', $code, \PDO::PARAM_STR);
        $statement->bindValue(':email', $_POST['email'], \PDO::PARAM_STR);
        $statement->execute();

        mail($_POST['email'], 'Password Reset', 'Confirmation code: ' . $code);

        return new View('passwordResetRequested');
    }
}





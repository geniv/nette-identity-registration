<?php declare(strict_types=1);

namespace Identity\Registration;

use GeneralForm\IFormContainer;
use Nette\Application\UI\Form;
use Nette\SmartObject;


/**
 * Class FormContainer
 *
 * @author  geniv
 * @package Identity\Registration
 */
class FormContainer implements IFormContainer
{
    use SmartObject;


    /**
     * Get form.
     *
     * @param Form $form
     */
    public function getForm(Form $form)
    {
        $form->addText('login', 'registration-form-login')
            ->setRequired('registration-form-login-required');

        $form->addPassword('password', 'registration-form-password')
            ->setRequired('registration-form-password-required');

        $form->addPassword('password2', 'registration-form-password2')
            ->setRequired('registration-form-password2-required')
            ->addRule(Form::EQUAL, 'registration-form-password2-equal', $form['password'])
            ->setOmitted();

        $form->addText('username', 'registration-form-username');

        $form->addText('email', 'registration-form-email')
            ->setRequired('registration-form-email-required')
            ->addRule(Form::EMAIL, 'registration-form-email-rule-email');

        $form->addSubmit('send', 'registration-form-send');
    }
}

<?php declare(strict_types=1);

namespace Identity\Registration;

use GeneralForm\GeneralControl;
use GeneralForm\IFormContainer;
use Nette\Localization\ITranslator;


/**
 * Class RegistrationForm
 *
 * @author  geniv
 * @package Identity\Registration
 */
class RegistrationForm extends GeneralControl
{

    /**
     * RegistrationForm constructor.
     *
     * @param IFormContainer   $formContainer
     * @param array            $events
     * @param ITranslator|null $translator
     */
    public function __construct(IFormContainer $formContainer, array $events, ITranslator $translator = null)
    {
        parent::__construct($formContainer, $events, $translator);

        $this->templatePath = __DIR__ . '/RegistrationForm.latte';  // set path
    }
}

<?php declare(strict_types=1);

namespace Identity\Registration\Bridges\Nette;

use GeneralForm\GeneralForm;
use Identity\Registration\FormContainer;
use Identity\Registration\RegistrationForm;
use Nette\DI\CompilerExtension;


/**
 * Class Extension
 *
 * @author  geniv
 * @package Identity\Registration\Bridges\Nette
 */
class Extension extends CompilerExtension
{
    /** @var array default values */
    private $defaults = [
        'autowired'     => true,
        'formContainer' => FormContainer::class,
        'events'        => [],
    ];


    /**
     * Load configuration.
     */
    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();
        $config = $this->validateConfig($this->defaults);

        $formContainer = GeneralForm::getDefinitionFormContainer($this);
        $events = GeneralForm::getDefinitionEventContainer($this);

        // define form
        $builder->addDefinition($this->prefix('form'))
            ->setFactory(RegistrationForm::class, [$formContainer, $events])
            ->setAutowired($config['autowired']);
    }
}

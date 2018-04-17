Identity registration
=====================

Installation
------------

```sh
$ composer require geniv/nette-identity-registration
```
or
```json
"geniv/nette-identity-registration": ">=1.0.0"
```

require:
```json
"php": ">=7.0.0",
"nette/nette": ">=2.4.0",
"geniv/nette-general-form": ">=1.0.0"
```

Include in application
----------------------

`CleanUserEvent` & `ApproveLinkEvent` _validate_ parameter format: http://php.net/manual/en/function.strtotime.php

`ApproveLinkEvent` _destination_ parameter is string for $presenter->link()

neon configure:
```neon
# identity registration
identityRegistration:
#   autowired: true
#   formContainer: Identity\Registration\FormContainer
    events:
        - Identity\Events\CleanUserEvent(-14 days)              # clean non active user
        - CallbackEvent                                         # check duplicity
        - SetValueEvent([active: false, role: guest])           # default value for registration
        - Identity\Events\RegistrationEvent                     # core registration
        - Identity\Events\ApproveLinkEvent(+1 hour, //link)     # generate approve link
        admin: Identity\Events\EmailNotifyEvent                 # email for admin
        user: Identity\Events\EmailNotifyEvent                  # email for user
```

neon configure extension:
```neon
extensions:
    identityRegistration: Identity\Registration\Bridges\Nette\Extension
```

presenter usage:
```php
protected function createComponentIdentityRegistration(RegistrationForm $registrationForm): RegistrationForm
{
    //$registrationForm->setTemplatePath(__DIR__ . '/templates/RegistrationForm.latte');
    $registrationForm->onSuccess[] = function (array $values) {
        $this->flashMessage('Registration!', 'info');
        $this->redirect('this');
    };
    $registrationForm->onException[] = function (RegistrationException $e) {
        $this->flashMessage('Registration exception! ' . $e->getMessage(), 'danger');
        $this->redirect('this');
    };
    return $registrationForm;
}
```

approve usage:
```php
public function actionApprove($h)
{
    try {
        if ($this->identityModel->processApprove($h)) {
            $this->flashMessage('Approve!', 'info');
        }
    } catch (IdentityException $e) {
        $this->flashMessage('Approve exception! ' . $e->getMessage(), 'danger');
    }
    $this->redirect('default');
}
```

latte usage:
```latte
{control identityRegistration}
```

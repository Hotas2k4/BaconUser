<?php
/**
 * BaconUser
 *
 * @link      http://github.com/Bacon/BaconUser For the canonical source repository
 * @copyright 2013 Ben Scholzen 'DASPRiD'
 * @license   http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace BaconUser\Form;

use BaconUser\Options\UserOptions;
use Zend\InputFilter\InputFilter;
use Zend\Validator\ValidatorInterface;

class RegistrationFilter extends InputFilter
{
    public function __construct(
        ValidatorInterface $emailUniqueValidator,
        ValidatorInterface $usernameUniqueValidator,
        UserOptions        $options
    ) {
        if ($options->getEnableUsername()) {
            $this->add(array(
                'name' => 'username',
                'required' => true,
                'filters' => array(array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 3,
                            'max' => 255,
                        ),
                    ),
                    $emailUniqueValidator,
                ),
            ));
        }

        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'EmailAddress'
                ),
                $usernameUniqueValidator
            ),
        ));

        if ($options->getEnableDisplayName()) {
            $this->add(array(
                'name' => 'display_name',
                'required' => false,
                'filters' => array(array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 3,
                            'max' => 255,
                        ),
                    ),
                ),
            ));
        }

        $this->add(array(
            'name' => 'password',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 6,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'password_verification',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 6,
                    ),
                ),
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password',
                    ),
                ),
            ),
        ));
    }
}
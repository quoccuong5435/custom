<?php 
    namespace Drupal\rsvplist\Form;
     
    use Drupal\Core\Form\FormBase;
    use Drupal\Core\Form\FormStateInterface;
    use Drupal\Core\Database\Database;
    use Drupal\User\Entity\User;
    use Drupal\Core\Render\Element\Form;
    use Drupal\jsonapi\JsonApiResource\Data;

    class RSVPForm extends FormBase
    {
        public function getFormId()
        {
            return 'rsvplist_email_form';
        }

        public function buildForm(array $form ,FormStateInterface $form_state )
        {
            $node = \Drupal::routeMatch()->getParameter('node');
            $nid="";
            if($node)
            {
                $nid = $node -> nid -> value;
            }
            
            $form['email'] = array(
                '#title' => t('Email Address'),
                '#type' => 'textfield', 
                '#size' => '25',
                '#description' => t('We will send updates to this email address your provider' ),
                '#required' => true

            );

            $form['submit']=  array(
                '#type' => 'submit',
                '#value' => t('RSVP')
            );

            $form['nid'] = array(   
                '#type' => 'hidden',
                '#value' => $nid,
            );

            return $form;
        }

        public function  validateForm(array &$form, FormStateInterface $form_state)
        {
            $email = $form_state->getValue('email');
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $form_state->setErrorByName('email', t('the email address is invalid.'));
            }
        }

        public function submitForm(array &$form , FormStateInterface $form_state)
        {
            $user  =   \Drupal::currentUser()->id();  
            $email = $form_state->getValue('email');
            $nid =  $form_state->getValue('nid');
            $fields =array(
                'email' => $email,
                'nid' => $nid,
                'uid' => $user,
                'created' => time(),
            );
            $query =    \Drupal::database();
            $query->insert('rsvplist')->fields($fields)->execute();
            \Drupal::messenger()-> addMessage('Successfully created');
        }


    }

?>
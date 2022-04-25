<?php 
  namespace Drupal\rsvplist\Form;
    /**
 * @file
 * Contains \Drupal\rsvplist\Form\RSVPSettingForm
 */
  use Drupal\Core\Form\ConfigFormBase;
  use Symfony\Component\HttpFoundation\Request;
  use Drupal\Core\Form\FormStateInterface;

  class RSVPSettingForm extends ConfigFormBase
  {
      
      public function getFormID() {
        return 'rsvplist_admin_settings';
      }

     public function  getEditableConfigNames()
     {
         return ['rsvplist.Settings'];
     }

     public function buildForm(array $form, FormStateInterface $form_state , Request $request = null)
     {
         $types = node_type_get_names();
         $config = $this -> config('rsvplist.Settings');
         $form['rsvplist_types'] = array(
            '#type' => 'checkboxes',
            '#title' => $this -> t('This content type enable RSVP collectios'),
            'default_value' => $config -> get('allowed_types'),
            '#options' => $types,
         );
         $form['array_filter'] = array(
            '#type' => 'value',
            '#value' => TRUE,
         );

         return  parent::buildForm($form, $form_state);
     }

     public function submitForm(array &$form, FormStateInterface $form_state)
     {
         $allowed_types =  array_filter($form_state -> getValue('rsvplist_types'));
         sort($allowed_types);
         $this-> config('rsvplist.Settings')-> set('allowed_types', $allowed_types)->save();
         parent::submitForm($form, $form_state);
     }
  }

?>
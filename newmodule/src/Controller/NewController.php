<?php 
    namespace Drupal\newmodule\Controller;

    use Drupal\Core\Controller\ControllerBase;

    class NewController extends ControllerBase {
        public function content()
        {
            return array(
                '#type' => 'markup',
                 '#markup' => t('This is my menu linked custom page'),
                );
        }
    
    }

?>
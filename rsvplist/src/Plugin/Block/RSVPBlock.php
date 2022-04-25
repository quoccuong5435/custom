<?php 
    namespace Drupal\rsvplist\Plugin\Block;

    use Drupal\Core\Block\BlockBase;
    use Drupal\Core\Access\AccessResult;
    use Drupal\Core\Session\AccountInterface;
    
    /**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "rsvplist_block",
 *   admin_label = @Translation("RSVP Block"),
 *   category = @Translation("Custom Block"),
 * )
 */
    class RSVPBlock extends  BlockBase
    {
        public function build() {
           return \Drupal::formBuilder() ->getForm('Drupal\rsvplist\Form\RSVPForm');
          }

          
    }

?>
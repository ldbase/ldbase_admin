<?php

namespace Drupal\ldbase_admin\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LdbaseAdminForm.
 */
class LdbaseAdminForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ldbase_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ldbase.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('ldbase.settings');

    $form['ldbase_matomo_user_token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Matomo User Token'),
      '#description' => $this->t('User token for authenticating to the Matomo API.'),
      '#default_value' => ( !empty($config->get('ldbase_matomo_user_token')) ? $config->get('ldbase_matomo_user_token') : '' ),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('ldbase.settings');
    $config->set('ldbase_matomo_user_token', $form_state->getValue('ldbase_matomo_user_token'));
    $config->save();
    parent::submitForm($form, $form_state);
  }

}

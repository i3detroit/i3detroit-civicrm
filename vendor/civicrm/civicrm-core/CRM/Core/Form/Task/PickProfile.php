<?php
/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 */

/**
 * This class provides the functionality for batch profile update for case
 */
abstract class CRM_Core_Form_Task_PickProfile extends CRM_Core_Form_Task {

  /**
   * The title of the group
   *
   * @var string
   */
  protected $_title;

  /**
   * Maximum entities that should be allowed to update
   *
   * @var int
   */
  protected $_maxEntities = 100;

  /**
   * Variable to store redirect path
   *
   * @var string
   */
  protected $_userContext;

  /**
   * Must be set to entity table name (eg. civicrm_participant) by child class
   *
   * @var string
   */
  public static $tableName = NULL;

  /**
   * Must be set to entity shortname (eg. event)
   *
   * @var string
   */
  public static $entityShortname = NULL;

  /**
   * Build all the data structures needed to build the form.
   *
   * @return void
   */
  public function preProcess() {
    // initialize the task and row fields
    parent::preProcess();
    $session = CRM_Core_Session::singleton();
    $this->_userContext = $session->readUserContext();

    $this->setTitle(ts('Update multiple ' . $this::$entityShortname . 's'));

    // validations
    if (count($this->_entityIds) > $this->_maxEntities) {
      CRM_Core_Session::setStatus(ts("The maximum number of %3 you can select for Update multiple %3 is %1. You have selected %2. Please select fewer %3 from your search results and try again.", [
        1 => $this->_maxEntities,
        2 => count($this->_entityIds),
        3 => $this::$entityShortname . 's',
      ]), ts('Update multiple records error'), 'error');
      CRM_Utils_System::redirect($this->_userContext);
    }
  }

  /**
   * Build the form object.
   *
   * @return void
   */
  public function buildQuickForm() {
    $types = [ucfirst($this::$entityShortname)];
    $profiles = CRM_Core_BAO_UFGroup::getProfiles($types, TRUE);

    if (empty($profiles)) {
      CRM_Core_Session::setStatus(
        ts("You will need to create a Profile containing the %1 fields you want to edit before you can use Update multiple %2. Navigate to Administer > Customize Data and Screens > Profiles to configure a Profile. Consult the online Administrator documentation for more information.",
          [
            1 => $types[0],
            2 => $this::$entityShortname . 's',
          ]),
        ts('Update multiple records error'),
        'error'
      );
      CRM_Utils_System::redirect($this->_userContext);
    }

    $this->add('select',
      'uf_group_id',
      ts('Select Profile'),
      [
        '' => ts('- select profile -'),
      ] + $profiles,
      TRUE
    );
    $this->addDefaultButtons(ts('Continue'));

    $taskComponent['lc'] = $this::$entityShortname;
    $taskComponent['ucfirst'] = ucfirst($this::$entityShortname);
    $this->assign('taskComponent', $taskComponent);
  }

  /**
   * Add local and global form rules.
   *
   * @return void
   */
  public function addRules() {
    $this->addFormRule(['CRM_' . ucfirst($this::$entityShortname) . '_Form_Task_PickProfile', 'formRule']);
  }

  /**
   * Global validation rules for the form.
   *
   * @param array $fields
   *   Posted values of the form.
   *
   * @return bool|array
   *   true if no errors, else array of errors
   */
  public static function formRule($fields) {
    return TRUE;
  }

  /**
   * Process the form after the input has been submitted and validated.
   *
   * @return void
   */
  public function postProcess() {
    $params = $this->exportValues();

    $this->set('ufGroupId', $params['uf_group_id']);

    // also reset the batch page so it gets new values from the db
    $this->controller->resetPage('Batch');
  }

}

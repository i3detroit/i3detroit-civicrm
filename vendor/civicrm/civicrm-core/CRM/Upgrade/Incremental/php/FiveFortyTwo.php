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
 * Upgrade logic for FiveFortyTwo */
class CRM_Upgrade_Incremental_php_FiveFortyTwo extends CRM_Upgrade_Incremental_Base {

  /**
   * Compute any messages which should be displayed beforeupgrade.
   *
   * Note: This function is called iteratively for each incremental upgrade step.
   * There must be a concrete step (eg 'X.Y.Z.mysql.tpl' or 'upgrade_X_Y_Z()').
   *
   * @param string $preUpgradeMessage
   * @param string $rev
   *   a version number, e.g. '4.4.alpha1', '4.4.beta3', '4.4.0'.
   * @param null $currentVer
   */
  public function setPreUpgradeMessage(&$preUpgradeMessage, $rev, $currentVer = NULL) {
    // Example: Generate a pre-upgrade message.
    // if ($rev == '5.12.34') {
    //   $preUpgradeMessage .= '<p>' . ts('A new permission, "%1", has been added. This permission is now used to control access to the Manage Tags screen.', array(1 => ts('manage tags'))) . '</p>';
    // }
  }

  /**
   * Compute any messages which should be displayed after upgrade.
   *
   * Note: This function is called iteratively for each incremental upgrade step.
   * There must be a concrete step (eg 'X.Y.Z.mysql.tpl' or 'upgrade_X_Y_Z()').
   *
   * @param string $postUpgradeMessage
   *   alterable.
   * @param string $rev
   *   an intermediate version; note that setPostUpgradeMessage is called repeatedly with different $revs.
   */
  public function setPostUpgradeMessage(&$postUpgradeMessage, $rev) {
    // Example: Generate a post-upgrade message.
    // if ($rev == '5.12.34') {
    //   $postUpgradeMessage .= '<br /><br />' . ts("By default, CiviCRM now disables the ability to import directly from SQL. To use this feature, you must explicitly grant permission 'import SQL datasource'.");
    // }
  }

  /*
   * Important! All upgrade functions MUST add a 'runSql' task.
   * Uncomment and use the following template for a new upgrade version
   * (change the x in the function name):
   */

  /**
   * Upgrade function.
   *
   * @param string $rev
   */
  public function upgrade_5_42_alpha1(string $rev): void {
    $this->addTask(ts('Upgrade DB to %1: SQL', [1 => $rev]), 'runSql', $rev);
    $contributeComponentID = CRM_Core_DAO::singleValueQuery('SELECT id from civicrm_component WHERE name = "CiviContribute"');
    $this->addTask(
      'Add option group for entity batch table (if you are using gift-aid you will need an extension update)',
      'addOptionGroup',
      [
        'name' => 'entity_batch_extends',
        'title' => ts('Entity Batch Extends'),
        'is_reserved' => 1,
        'is_active' => 1,
        'is_locked' => 1,
      ],
      [
        [
          'name' => 'civicrm_financial_trxn',
          'value' => 'civicrm_financial_trxn',
          'label' => ts('Financial Transactions'),
          'component_id' => $contributeComponentID,
        ],
      ]
    );
  }

}

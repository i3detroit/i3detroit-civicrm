<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Pledge/PledgePayment.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:bfa7183802af9f28111c1d7c7dc6af5a)
 */

/**
 * Database access object for the PledgePayment entity.
 */
class CRM_Pledge_DAO_PledgePayment extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '2.1';
  const COMPONENT = 'CiviPledge';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_pledge_payment';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * @var int
   */
  public $id;

  /**
   * FK to Pledge table
   *
   * @var int
   */
  public $pledge_id;

  /**
   * FK to contribution table.
   *
   * @var int
   */
  public $contribution_id;

  /**
   * Pledged amount for this payment (the actual contribution amount might be different).
   *
   * @var float
   */
  public $scheduled_amount;

  /**
   * Actual amount that is paid as the Pledged installment amount.
   *
   * @var float
   */
  public $actual_amount;

  /**
   * 3 character string, value from config setting or input via user.
   *
   * @var string
   */
  public $currency;

  /**
   * The date the pledge payment is supposed to happen.
   *
   * @var datetime
   */
  public $scheduled_date;

  /**
   * The date that the most recent payment reminder was sent.
   *
   * @var datetime
   */
  public $reminder_date;

  /**
   * The number of payment reminders sent.
   *
   * @var int
   */
  public $reminder_count;

  /**
   * @var int
   */
  public $status_id;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_pledge_payment';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Pledge Payments') : ts('Pledge Payment');
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'pledge_id', 'civicrm_pledge', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'contribution_id', 'civicrm_contribution', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'pledge_payment_id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Payment ID'),
          'required' => TRUE,
          'import' => TRUE,
          'where' => 'civicrm_pledge_payment.id',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '2.1',
        ],
        'pledge_id' => [
          'name' => 'pledge_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Pledge ID'),
          'description' => ts('FK to Pledge table'),
          'required' => TRUE,
          'where' => 'civicrm_pledge_payment.pledge_id',
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'FKClassName' => 'CRM_Pledge_DAO_Pledge',
          'html' => [
            'label' => ts("Pledge"),
          ],
          'add' => '2.1',
        ],
        'contribution_id' => [
          'name' => 'contribution_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contribution ID'),
          'description' => ts('FK to contribution table.'),
          'where' => 'civicrm_pledge_payment.contribution_id',
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contribute_DAO_Contribution',
          'html' => [
            'label' => ts("Contribution"),
          ],
          'add' => '2.1',
        ],
        'pledge_payment_scheduled_amount' => [
          'name' => 'scheduled_amount',
          'type' => CRM_Utils_Type::T_MONEY,
          'title' => ts('Scheduled Amount'),
          'description' => ts('Pledged amount for this payment (the actual contribution amount might be different).'),
          'required' => TRUE,
          'precision' => [
            20,
            2,
          ],
          'import' => TRUE,
          'where' => 'civicrm_pledge_payment.scheduled_amount',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'add' => '2.1',
        ],
        'pledge_payment_actual_amount' => [
          'name' => 'actual_amount',
          'type' => CRM_Utils_Type::T_MONEY,
          'title' => ts('Actual Amount'),
          'description' => ts('Actual amount that is paid as the Pledged installment amount.'),
          'precision' => [
            20,
            2,
          ],
          'import' => TRUE,
          'where' => 'civicrm_pledge_payment.actual_amount',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'add' => '3.2',
        ],
        'currency' => [
          'name' => 'currency',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Currency'),
          'description' => ts('3 character string, value from config setting or input via user.'),
          'maxlength' => 3,
          'size' => CRM_Utils_Type::FOUR,
          'where' => 'civicrm_pledge_payment.currency',
          'default' => 'NULL',
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_currency',
            'keyColumn' => 'name',
            'labelColumn' => 'full_name',
            'nameColumn' => 'name',
            'abbrColumn' => 'symbol',
          ],
          'add' => '3.2',
        ],
        'pledge_payment_scheduled_date' => [
          'name' => 'scheduled_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Scheduled Date'),
          'description' => ts('The date the pledge payment is supposed to happen.'),
          'required' => TRUE,
          'import' => TRUE,
          'where' => 'civicrm_pledge_payment.scheduled_date',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'unique_title' => ts('Payment Scheduled'),
          'html' => [
            'type' => 'Select Date',
            'formatType' => 'activityDate',
          ],
          'add' => '2.1',
        ],
        'pledge_payment_reminder_date' => [
          'name' => 'reminder_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Last Reminder'),
          'description' => ts('The date that the most recent payment reminder was sent.'),
          'import' => TRUE,
          'where' => 'civicrm_pledge_payment.reminder_date',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'add' => '2.1',
        ],
        'pledge_payment_reminder_count' => [
          'name' => 'reminder_count',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Reminders Sent'),
          'description' => ts('The number of payment reminders sent.'),
          'import' => TRUE,
          'where' => 'civicrm_pledge_payment.reminder_count',
          'export' => TRUE,
          'default' => '0',
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'add' => '2.1',
        ],
        'pledge_payment_status_id' => [
          'name' => 'status_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Payment Status'),
          'import' => TRUE,
          'where' => 'civicrm_pledge_payment.status_id',
          'export' => FALSE,
          'table_name' => 'civicrm_pledge_payment',
          'entity' => 'PledgePayment',
          'bao' => 'CRM_Pledge_BAO_PledgePayment',
          'localizable' => 0,
          'pseudoconstant' => [
            'optionGroupName' => 'contribution_status',
            'optionEditPath' => 'civicrm/admin/options/contribution_status',
          ],
          'add' => '2.1',
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return self::$_tableName;
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'pledge_payment', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'pledge_payment', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [
      'index_contribution_pledge' => [
        'name' => 'index_contribution_pledge',
        'field' => [
          0 => 'contribution_id',
          1 => 'pledge_id',
        ],
        'localizable' => FALSE,
        'sig' => 'civicrm_pledge_payment::0::contribution_id::pledge_id',
      ],
      'index_status' => [
        'name' => 'index_status',
        'field' => [
          0 => 'status_id',
        ],
        'localizable' => FALSE,
        'sig' => 'civicrm_pledge_payment::0::status_id',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}

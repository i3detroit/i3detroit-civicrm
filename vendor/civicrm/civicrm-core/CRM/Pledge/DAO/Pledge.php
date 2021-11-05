<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Pledge/Pledge.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:bcc7d49479de858804a09bf49c1ebda9)
 */

/**
 * Database access object for the Pledge entity.
 */
class CRM_Pledge_DAO_Pledge extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '2.1';
  const COMPONENT = 'CiviPledge';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_pledge';

  /**
   * Icon associated with this entity.
   *
   * @var string
   */
  public static $_icon = 'fa-paper-plane';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * Pledge ID
   *
   * @var int
   */
  public $id;

  /**
   * Foreign key to civicrm_contact.id .
   *
   * @var int
   */
  public $contact_id;

  /**
   * FK to Financial Type
   *
   * @var int
   */
  public $financial_type_id;

  /**
   * The Contribution Page which triggered this contribution
   *
   * @var int
   */
  public $contribution_page_id;

  /**
   * Total pledged amount.
   *
   * @var float
   */
  public $amount;

  /**
   * Original amount for each of the installments.
   *
   * @var float
   */
  public $original_installment_amount;

  /**
   * 3 character string, value from config setting or input via user.
   *
   * @var string
   */
  public $currency;

  /**
   * Time units for recurrence of pledge payments.
   *
   * @var string
   */
  public $frequency_unit;

  /**
   * Number of time units for recurrence of pledge payments.
   *
   * @var int
   */
  public $frequency_interval;

  /**
   * Day in the period when the pledge payment is due e.g. 1st of month, 15th etc. Use this to set the scheduled dates for pledge payments.
   *
   * @var int
   */
  public $frequency_day;

  /**
   * Total number of payments to be made.
   *
   * @var int
   */
  public $installments;

  /**
   * The date the first scheduled pledge occurs.
   *
   * @var datetime
   */
  public $start_date;

  /**
   * When this pledge record was created.
   *
   * @var datetime
   */
  public $create_date;

  /**
   * When a pledge acknowledgement message was sent to the contributor.
   *
   * @var datetime
   */
  public $acknowledge_date;

  /**
   * Last updated date for this pledge record.
   *
   * @var datetime
   */
  public $modified_date;

  /**
   * Date this pledge was cancelled by contributor.
   *
   * @var datetime
   */
  public $cancel_date;

  /**
   * Date this pledge finished successfully (total pledge payments equal to or greater than pledged amount).
   *
   * @var datetime
   */
  public $end_date;

  /**
   * The maximum number of payment reminders to send for any given payment.
   *
   * @var int
   */
  public $max_reminders;

  /**
   * Send initial reminder this many days prior to the payment due date.
   *
   * @var int
   */
  public $initial_reminder_day;

  /**
   * Send additional reminder this many days after last one sent, up to maximum number of reminders.
   *
   * @var int
   */
  public $additional_reminder_day;

  /**
   * Implicit foreign key to civicrm_option_values in the pledge_status option group.
   *
   * @var int
   */
  public $status_id;

  /**
   * @var bool
   */
  public $is_test;

  /**
   * The campaign for which this pledge has been initiated.
   *
   * @var int
   */
  public $campaign_id;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_pledge';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Pledges') : ts('Pledge');
  }

  /**
   * Returns user-friendly description of this entity.
   *
   * @return string
   */
  public static function getEntityDescription() {
    return ts('Promises to contribute at a future time, either in full, or at regular intervals until a total goal is reached.');
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
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'contact_id', 'civicrm_contact', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'financial_type_id', 'civicrm_financial_type', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'contribution_page_id', 'civicrm_contribution_page', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'campaign_id', 'civicrm_campaign', 'id');
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
        'pledge_id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Pledge ID'),
          'description' => ts('Pledge ID'),
          'required' => TRUE,
          'import' => TRUE,
          'where' => 'civicrm_pledge.id',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '2.1',
        ],
        'pledge_contact_id' => [
          'name' => 'contact_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contact ID'),
          'description' => ts('Foreign key to civicrm_contact.id .'),
          'required' => TRUE,
          'import' => TRUE,
          'where' => 'civicrm_pledge.contact_id',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contact_DAO_Contact',
          'html' => [
            'type' => 'EntityRef',
            'label' => ts("Contact"),
          ],
          'add' => '2.1',
        ],
        'pledge_financial_type_id' => [
          'name' => 'financial_type_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Financial Type ID'),
          'description' => ts('FK to Financial Type'),
          'where' => 'civicrm_pledge.financial_type_id',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'FKClassName' => 'CRM_Financial_DAO_FinancialType',
          'html' => [
            'type' => 'Select',
            'label' => ts("Financial Type"),
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_financial_type',
            'keyColumn' => 'id',
            'labelColumn' => 'name',
          ],
          'add' => '4.3',
        ],
        'pledge_contribution_page_id' => [
          'name' => 'contribution_page_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contribution Page ID'),
          'description' => ts('The Contribution Page which triggered this contribution'),
          'where' => 'civicrm_pledge.contribution_page_id',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contribute_DAO_ContributionPage',
          'html' => [
            'label' => ts("Contribution Page"),
          ],
          'add' => '2.1',
        ],
        'pledge_amount' => [
          'name' => 'amount',
          'type' => CRM_Utils_Type::T_MONEY,
          'title' => ts('Total Pledged'),
          'description' => ts('Total pledged amount.'),
          'required' => TRUE,
          'precision' => [
            20,
            2,
          ],
          'import' => TRUE,
          'where' => 'civicrm_pledge.amount',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.1',
        ],
        'pledge_original_installment_amount' => [
          'name' => 'original_installment_amount',
          'type' => CRM_Utils_Type::T_MONEY,
          'title' => ts('Original Installment Amount'),
          'description' => ts('Original amount for each of the installments.'),
          'required' => TRUE,
          'precision' => [
            20,
            2,
          ],
          'where' => 'civicrm_pledge.original_installment_amount',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '3.2',
        ],
        'currency' => [
          'name' => 'currency',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Pledge Currency'),
          'description' => ts('3 character string, value from config setting or input via user.'),
          'maxlength' => 3,
          'size' => CRM_Utils_Type::FOUR,
          'where' => 'civicrm_pledge.currency',
          'default' => 'NULL',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
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
        'pledge_frequency_unit' => [
          'name' => 'frequency_unit',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Pledge Frequency Unit'),
          'description' => ts('Time units for recurrence of pledge payments.'),
          'required' => TRUE,
          'maxlength' => 8,
          'size' => CRM_Utils_Type::EIGHT,
          'where' => 'civicrm_pledge.frequency_unit',
          'default' => 'month',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'pseudoconstant' => [
            'optionGroupName' => 'recur_frequency_units',
            'keyColumn' => 'name',
            'optionEditPath' => 'civicrm/admin/options/recur_frequency_units',
          ],
          'add' => '2.1',
        ],
        'pledge_frequency_interval' => [
          'name' => 'frequency_interval',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Pledge Frequency Interval'),
          'description' => ts('Number of time units for recurrence of pledge payments.'),
          'required' => TRUE,
          'where' => 'civicrm_pledge.frequency_interval',
          'default' => '1',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.1',
        ],
        'frequency_day' => [
          'name' => 'frequency_day',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Pledge day'),
          'description' => ts('Day in the period when the pledge payment is due e.g. 1st of month, 15th etc. Use this to set the scheduled dates for pledge payments.'),
          'required' => TRUE,
          'where' => 'civicrm_pledge.frequency_day',
          'default' => '3',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'add' => '2.1',
        ],
        'installments' => [
          'name' => 'installments',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Pledge Number of Installments'),
          'description' => ts('Total number of payments to be made.'),
          'required' => TRUE,
          'where' => 'civicrm_pledge.installments',
          'export' => TRUE,
          'default' => '1',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.1',
        ],
        'pledge_start_date' => [
          'name' => 'start_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Pledge Start Date'),
          'description' => ts('The date the first scheduled pledge occurs.'),
          'required' => TRUE,
          'where' => 'civicrm_pledge.start_date',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'unique_title' => ts('Payments Start Date'),
          'html' => [
            'type' => 'Select Date',
            'formatType' => 'activityDate',
          ],
          'add' => '2.1',
        ],
        'pledge_create_date' => [
          'name' => 'create_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Pledge Made'),
          'description' => ts('When this pledge record was created.'),
          'required' => TRUE,
          'import' => TRUE,
          'where' => 'civicrm_pledge.create_date',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Select Date',
            'formatType' => 'activityDate',
          ],
          'add' => '2.1',
        ],
        'acknowledge_date' => [
          'name' => 'acknowledge_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Pledge Acknowledged'),
          'description' => ts('When a pledge acknowledgement message was sent to the contributor.'),
          'where' => 'civicrm_pledge.acknowledge_date',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Select Date',
            'formatType' => 'activityDate',
          ],
          'add' => '2.1',
        ],
        'modified_date' => [
          'name' => 'modified_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Pledge Modified Date'),
          'description' => ts('Last updated date for this pledge record.'),
          'where' => 'civicrm_pledge.modified_date',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'readonly' => TRUE,
          'add' => '2.1',
        ],
        'cancel_date' => [
          'name' => 'cancel_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Pledge Cancelled Date'),
          'description' => ts('Date this pledge was cancelled by contributor.'),
          'where' => 'civicrm_pledge.cancel_date',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Select Date',
            'formatType' => 'activityDate',
          ],
          'add' => '2.1',
        ],
        'pledge_end_date' => [
          'name' => 'end_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Pledge End Date'),
          'description' => ts('Date this pledge finished successfully (total pledge payments equal to or greater than pledged amount).'),
          'where' => 'civicrm_pledge.end_date',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'unique_title' => ts('Payments Ended Date'),
          'html' => [
            'type' => 'Select Date',
            'formatType' => 'activityDate',
          ],
          'add' => '2.1',
        ],
        'max_reminders' => [
          'name' => 'max_reminders',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Maximum Number of Reminders'),
          'description' => ts('The maximum number of payment reminders to send for any given payment.'),
          'where' => 'civicrm_pledge.max_reminders',
          'default' => '1',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.1',
        ],
        'initial_reminder_day' => [
          'name' => 'initial_reminder_day',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Initial Reminder Day'),
          'description' => ts('Send initial reminder this many days prior to the payment due date.'),
          'where' => 'civicrm_pledge.initial_reminder_day',
          'default' => '5',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'add' => '2.1',
        ],
        'additional_reminder_day' => [
          'name' => 'additional_reminder_day',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Additional Reminder Days'),
          'description' => ts('Send additional reminder this many days after last one sent, up to maximum number of reminders.'),
          'where' => 'civicrm_pledge.additional_reminder_day',
          'default' => '5',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '2.1',
        ],
        'pledge_status_id' => [
          'name' => 'status_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Pledge Status ID'),
          'description' => ts('Implicit foreign key to civicrm_option_values in the pledge_status option group.'),
          'required' => TRUE,
          'import' => TRUE,
          'where' => 'civicrm_pledge.status_id',
          'export' => FALSE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'pseudoconstant' => [
            'optionGroupName' => 'pledge_status',
            'optionEditPath' => 'civicrm/admin/options/pledge_status',
          ],
          'add' => '2.1',
        ],
        'pledge_is_test' => [
          'name' => 'is_test',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Test'),
          'required' => TRUE,
          'import' => TRUE,
          'where' => 'civicrm_pledge.is_test',
          'export' => TRUE,
          'default' => '0',
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
          ],
          'add' => NULL,
        ],
        'pledge_campaign_id' => [
          'name' => 'campaign_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Campaign ID'),
          'description' => ts('The campaign for which this pledge has been initiated.'),
          'import' => TRUE,
          'where' => 'civicrm_pledge.campaign_id',
          'export' => TRUE,
          'table_name' => 'civicrm_pledge',
          'entity' => 'Pledge',
          'bao' => 'CRM_Pledge_BAO_Pledge',
          'localizable' => 0,
          'FKClassName' => 'CRM_Campaign_DAO_Campaign',
          'component' => 'CiviCampaign',
          'html' => [
            'type' => 'EntityRef',
            'label' => ts("Campaign"),
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_campaign',
            'keyColumn' => 'id',
            'labelColumn' => 'title',
            'prefetch' => 'FALSE',
          ],
          'add' => '3.4',
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'pledge', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'pledge', $prefix, []);
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
      'index_status' => [
        'name' => 'index_status',
        'field' => [
          0 => 'status_id',
        ],
        'localizable' => FALSE,
        'sig' => 'civicrm_pledge::0::status_id',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}

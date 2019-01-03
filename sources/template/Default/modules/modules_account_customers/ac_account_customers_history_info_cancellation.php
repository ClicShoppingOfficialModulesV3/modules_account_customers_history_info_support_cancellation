<?php
/**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT
 *  @licence MIT - Portion of osCommerce 2.4
 *  @Info : https://www.clicshopping.org/forum/trademark/
 *
 */

  use ClicShopping\OM\HTML;
  use ClicShopping\OM\CLICSHOPPING;
  use ClicShopping\OM\Registry;

  class ac_account_customers_history_info_cancellation {

    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct() {
      $this->code = get_class($this);
      $this->group = basename(__DIR__);

      $this->title = CLICSHOPPING::getDef('module_account_customers_history_info_cancellation_title');
      $this->description = CLICSHOPPING::getDef('module_account_customers_history_info_cancellation_description');

      if (defined('MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_TITLE_STATUS')) {
        $this->sort_order = MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_TITLE_SORT_ORDER;
        $this->enabled = (MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_TITLE_STATUS == 'True');
      }
    }

    public function execute() {
      $CLICSHOPPING_Template = Registry::get('Template');

      if (isset($_GET['Account']) &&  isset($_GET['HistoryInfo']) ) {

        $content_width = (int)MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_CONTENT_WIDTH;

        $link_cancellation = HTML::link(CLICSHOPPING::link(null,  'Info&Contact&order_id=' . (int)$_GET['order_id']), CLICSHOPPING::getDef('module_account_customers_history_info_cancellation_text_info'));

        $account_history = '<!-- Start ac_account_customers_history_info_cancellation --> ' . "\n";

        ob_start();
        require($CLICSHOPPING_Template->getTemplateModules($this->group . '/content/account_customers_history_info_cancellation'));
        $account_history .= ob_get_clean();

        $account_history .= '<!-- end ac_account_customers_history_info_cancellation -->' . "\n";

        $CLICSHOPPING_Template->addBlock($account_history, $this->group);

      } // php_self
    } // function execute

    public function isEnabled() {
      return $this->enabled;
    }

    public function check() {
      return defined('MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_TITLE_STATUS');
    }

    public function install() {
      $CLICSHOPPING_Db = Registry::get('Db');

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Souhaitez-vous activer ce module ?',
          'configuration_key' => 'MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_TITLE_STATUS',
          'configuration_value' => 'True',
          'configuration_description' => 'Souhaitez vous activer ce module à votre boutique ?',
          'configuration_group_id' => '6',
          'sort_order' => '1',
          'set_function' => 'clic_cfg_set_boolean_value(array(\'True\', \'False\'))',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Veuillez selectionner la largeur de l\'affichage?',
          'configuration_key' => 'MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_CONTENT_WIDTH',
          'configuration_value' => '12',
          'configuration_description' => 'Veuillez indiquer un nombre compris entre 1 et 12',
          'configuration_group_id' => '6',
          'sort_order' => '1',
          'set_function' => 'clic_cfg_set_content_module_width_pull_down',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Ordre de tri d\'affichage',
          'configuration_key' => 'MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_TITLE_SORT_ORDER',
          'configuration_value' => '45',
          'configuration_description' => 'Ordre de tri pour l\'affichage (Le plus petit nombre est montré en premier)',
          'configuration_group_id' => '6',
          'sort_order' => '100',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      return $CLICSHOPPING_Db->save('configuration', ['configuration_value' => '1'],
        ['configuration_key' => 'WEBSITE_MODULE_INSTALLED']
      );

    }

    public function remove() {
      return Registry::get('Db')->exec('delete from :table_configuration where configuration_key in ("' . implode('", "', $this->keys()) . '")');
    }

    public function keys() {
      return array (
        'MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_TITLE_STATUS',
        'MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_CONTENT_WIDTH',
        'MODULE_ACCOUNT_CUSTOMERS_HISTORY_INFO_CANCELLATION_TITLE_SORT_ORDER'
      );
    }
  }
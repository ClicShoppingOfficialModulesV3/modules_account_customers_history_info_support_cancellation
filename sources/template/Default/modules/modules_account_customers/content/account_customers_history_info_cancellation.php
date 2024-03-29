<?php
  /**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT

 *  @Info : https://www.clicshopping.org/forum/trademark/
 *
 */

  use ClicShopping\OM\CLICSHOPPING;
?>
<div class="col-md-<?php echo $content_width; ?>">
  <div class="separator"></div>
  <div class="card"
>
    <div class="card-header">
      <div class="row">
        <div class="modulesAccountCustomersHistoryInfoCancellationText"><h3><?php echo CLICSHOPPING::getDef('module_account_customers_history_info_cancellation_text'); ?></h3></div>
      </div>
    </div>
    <div class="card-block">
      <div class="separator"></div>
      <div class="card-text">
        <div class="col-md-12">
          <div class="modulesAccountCustomersHistoryInfoCancellationTextComment"><?php echo CLICSHOPPING::getDef('module_account_customers_history_info_cancellation_text_comment'); ?></div>
          <div class="separator"></div>
          <i class="bi bi-arrow-right"></i>
          <?php echo $link_cancellation; ?>
        </div>
      </div>
    </div>
  </div>
</div>
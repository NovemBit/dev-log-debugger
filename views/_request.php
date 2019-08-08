<?php use DevLog\DataMapper\Models\LogData;
use DevLog\DevLogHelper;
/** @var \DevLog\DataMapper\Models\Log $instance */
?>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab"
           href="#server">$_SERVER</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab"
           href="#session">$_SESSION</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab"
           href="#env">$_ENV</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab"
           href="#get">$_GET</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab"
           href="#post">$_POST</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab"
           href="#cookie">$_COOKIE</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab"
           href="#files">$_FILES</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab"
           href="#request-headers">Request Headers</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab"
           href="#response-headers">Request Headers</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

    <div class="tab-pane active" id="server">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('_server')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

    <div class="tab-pane" id="session">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('_session')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

    <div class="tab-pane" id="env">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('_env')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

    <div class="tab-pane" id="get">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('_get')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

    <div class="tab-pane" id="post">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('_post')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

    <div class="tab-pane" id="cookie">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('_cookie')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

    <div class="tab-pane" id="files">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('_files')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

    <div class="tab-pane" id="request-headers">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('request_headers')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

    <div class="tab-pane" id="response-headers">
		<?php echo DevLogHelper::dump( $instance->getDataList()->getData('response_headers')->getValue(LogData::ASSOC), 'table' ); ?>
    </div>

</div>

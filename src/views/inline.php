<?php

use DevLog\DataMapper\Models\LogData;
use DevLog\DevLog;
use DevLog\DevLogHelper;

?>

<?php
/** @var \DevLog\DataMapper\Models\Log $instance */
$url = DevLogHelper::getActualUrlFromServer( $instance->getDataList()->getData( '_server' )->getValue(LogData::ASSOC ) );
?>

<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">

    <div class="btn-group" role="group" aria-label="First group">
        <a role="button" target="_blank" href="/<?php echo DEV_LOG_DEBUGGER_URL_PATH; ?>/view/<?php echo $name; ?>"
           class="btn btn-dark"><?php echo DevLog::$scriptName; ?></a>
        <button type="button" class="btn btn-secondary"><span
                    title="<?php echo $url; ?>"><?php echo DevLogHelper::trimString( $url ); ?></span></button>
        <button type="button" class="btn btn-primary">
            Method: <?php echo $instance->getDataList()->getData( '_server' )->getValue( LogData::ASSOC )['REQUEST_METHOD']; ?></button>
        <button type="button" class="btn btn-default">
            Status: <?php echo DevLogHelper::getHttpStatusBadge( $instance->getDataList()->getData( 'status' )->getValue() ); ?></button>
        <button type="button" class="btn btn-success">
            RAM: <?php echo DevLogHelper::getMemUsageReadable( $instance->getDataList()->getData( 'memory_usage' )->getValue() ); ?></button>
        <button type="button" class="btn btn-default">
            Time: <?php echo round( $instance->getDataList()->getData( 'end_time' )->getValue() - $instance->getDataList()->getData( 'start_time' )->getValue(), 5 ); ?>
            s
        </button>
    </div>


</div>

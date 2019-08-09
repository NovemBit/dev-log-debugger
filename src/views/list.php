<?php

use DevLog\DataMapper\Models\LogData;
use DevLog\DevLogHelper;

/** @var \DevLog\DataMapper\Models\Log[] $instances */

?>
<div class="mt-3">
    <form onsubmit="return confirm('Do you really want to delete all logs?');" action="" method="post">
        <input type="hidden" name="delete_all" value="1">
        <input class="btn btn-danger btn-sm" type="submit" value="Delete all">
    </form>

    <p>
        Total logs count: <?php echo count( $instances ); ?>
    </p>
</div>

<table class="mt-3 table table-dark table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Hash</th>
        <th>URI</th>
        <th>IP</th>
        <th>Method</th>
        <th>Status</th>
        <th>XHR</th>
        <th>Time</th>
        <th>Memory</th>
        <th>Load time</th>
    </tr>
    </thead>
    <tbody>

	<?php
	$i = 1;
	foreach ( $instances as $id => $instance ): ?>
		<?php
		$url = DevLogHelper::getActualUrlFromServer( $instance->getDataList()->getData( '_server' )->getValue( ) );
		?>
        <tr>
            <td><?php echo $i;
				$i ++; ?></td>
            <td>
                <a href="/<?php echo DEV_LOG_DEBUGGER_URL_PATH; ?>/view/<?php echo $instance->getName(); ?>"><?php echo DevLogHelper::trimString( $instance->getName(), '12', '' ); ?></a>
            </td>
            <td><span title="<?php echo $url; ?>"><?php echo DevLogHelper::trimString( $url ); ?></span></td>
            <td><?php echo DevLogHelper::getUserIpAddressFromServer( $instance->getDataList()->getData( '_server' )->getValue( LogData::ASSOC ) ); ?></td>
            <td><?php echo $instance->getDataList()->getData( '_server' )->getValue( LogData::ASSOC )['REQUEST_METHOD']; ?></td>
            <td><?php echo DevLogHelper::getHttpStatusBadge( $instance->getDataList()->getData( 'status' )->getValue() ); ?></td>
            <td><?php echo DevLogHelper::isXHRFromServer( $instance->getDataList()->getData( '_server' )->getValue( LogData::ASSOC ) ) ? "Yes" : "No"; ?></td>
            <td><?php echo date( 'Y-m-d H:i:s', $instance->getDataList()->getData( 'start_time' )->getValue() ); ?></td>
            <td><?php echo DevLogHelper::getMemUsageReadable( $instance->getDataList()->getData( 'memory_usage' )->getValue() ); ?></td>
            <td><?php echo round( $instance->getDataList()->getData( 'end_time' )->getValue() - $instance->getDataList()->getData( 'start_time' )->getValue(), 5 ); ?></td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>



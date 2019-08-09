<?php

use DevLog\DevLog;
use DevLog\DevLogHelper;

?>

<table class="table table-dark table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Criteria</th>
        <th>Serve Instances</th>
        <th>Groups</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>

	<?php /** @var \DevLog\DevLogServe[] $instances */
	foreach ( $instances as $id => $instance ): ?>
		<?php
		$tracker = DevLog::getTrackers()[ $id ] ?>
        <tr>
            <td>
                <a href="/<?php echo DEV_LOG_DEBUGGER_URL_PATH; ?>/track/view/<?php echo $id; ?>"><?php echo DevLogHelper::trimString( $id, '100', '' ); ?></a>
            </td>
            <td>
				<?php echo isset( $tracker['criteria'] ) ? count( $tracker['criteria'] ) : 0; ?>
            </td>
            <td>
		        <?php echo [
			        true  => 'Yes',
			        false => 'No'
		        ][ isset( $tracker['serve_instances'] ) ? $tracker['serve_instances'] : false ]; ?>
            </td>
            <td>
		        <?php echo isset( $tracker['group_by'] ) ? count( $tracker['group_by'] ) : 0; ?>
            </td>
            <td>
                <form  onsubmit="return confirm('Do you really want to delete the tracker?');" action="track/delete/<?php echo $id;?>" method="post">
                    <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                </form>
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>



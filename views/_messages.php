<?php
/** @var int $log_id */

$criteria = [
	[ 'log_id', '=', $log_id ],
];

$type     = $_GET['type'] ?? null;
$category = $_GET['category'] ?? null;
$message  = $_GET['message'] ?? null;

$page      = $_GET['page'] ?? 1;
$page_size = $_GET['page_size'] ?? 50;
$page_size = $page_size > 500 ? 500 : $page_size;

if ( $type ) {
	$criteria[] = [ 'type', 'LIKE', $_GET['type'] ];
}

if ( $category ) {
	$criteria[] = [ 'category', 'LIKE', $_GET['category'] ];
}

if ( $message ) {
	$criteria[] = [ 'message', 'LIKE', "%" . $_GET['message'] . "%" ];
}


$messages = \DevLog\DataMapper\Mappers\LogMessage::get(
	$criteria,
	[ 'id' => 'ASC' ],
	[ ( ( $page - 1 ) * $page_size ), $page_size ]
)->getList();
?>

<form class="form" method="get" action="">
    <input type="submit" class="d-none">
    <div class="form-group">

        <label>
            <input class="form-control" type="number" step="10" min="10" name="page_size"
                   value="<?php echo $page_size; ?>" placeholder="Page size">
        </label>

        <ul class="pagination">
            <li class="page-item">
                <button class="form-control" type="submit" name="page" value="1">First</button>
            </li>

            <li class="page-item">
                <button class="form-control" type="submit" name="page" value="<?php echo $page + 1; ?>">Next</button>
            </li>
        </ul>

    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>
                <label>
                    <input class="form-control" name="type" value="<?php echo $type; ?>" type="text" placeholder="Type">
                </label>
            </th>
            <th><label>
                    <input class="form-control" name="category" value="<?php echo $category; ?>" type="text"
                           placeholder="Category">
                </label>
            </th>
            <th><label>
                    <input class="form-control" name="message" value="<?php echo $message; ?>" type="text"
                           placeholder="Message">
                </label>
            </th>
            <th>
                <label>
                    <input class="form-control" name="Time" type="text" placeholder="Time">
                </label>
            </th>
        </tr>
        </thead>
        <tbody>

		<?php /** @var \DevLog\DataMapper\Models\LogMessage[] $messages */

		use DevLog\DataMapper\Models\LogMessage;
		use DevLog\DevLog;

		foreach ( $messages as $id => $message ): ?>
            <tr class="<?php echo isset( DevLog::$messageTypes[ $message->getType() ] ) ? DevLog::$messageTypes[ $message->getType() ] : 'table-primary'; ?>">
                <td><?php echo $id + 1; ?></td>
                <td><?php echo $message->getType(); ?></td>
                <td><?php echo $message->getCategory(); ?></td>
                <td>
                    <pre><?php echo \DevLog\DevLogHelper::dump( $message->getMessage(LogMessage::ASSOC), 'dump' ); ?></pre>
                </td>
                <td><?php echo $message->getTime(); ?></td>
            </tr>

		<?php endforeach; ?>

        </tbody>
    </table>
</form>
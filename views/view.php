<?php
/** @var \DevLog\DataMapper\Models\Log $instance */

?>
<div class="row">

    <div class="col-sm-3">

		<?php

		use DevLog\DataMapper\Models\LogData;
		use DevLog\DevLogHelper;

		echo \DevLog\DevLogHelper::getMenu( [
			[ 'label' => 'Messages', 'url' => '?tab=messages' ],
			[ 'label' => 'Configuration', 'url' => '?tab=configuration' ],
			[ 'label' => 'Request', 'url' => '?tab=request' ],
		], [ 'items' => [ 'class' => 'list-group-item list-group-item-action' ] ] );


		$url = DevLogHelper::getActualUrlFromServer( $instance->getDataList()->getData( "_server" )->getValue( LogData::ASSOC ) );

		?>

    </div>


    <div class="col-sm-9">

        <div class="alert alert-success" role="alert">

			<?php echo sprintf(
				'%1$s: <span class="font-weight-bold">%2$s</span> <a href="%3$s">%3$s</a> at <span class="font-weight-bold">%4$s</span> by <span class="font-weight-bold">%5$s</span>',
				$instance->getName(),
				$instance->getDataList()->getData( "_server" )->getValue( LogData::ASSOC )['REQUEST_METHOD'],
				$url,
				date( 'Y-m-d H:i:s', $instance->getDataList()->getData( "start_time" )->getValue() ),
				DevLogHelper::getUserIpAddressFromServer( $instance->getDataList()->getData( "_server" )->getValue( LogData::ASSOC ) )
			); ?>

        </div>


		<?php
		$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : "messages";

		switch ( $tab ) {
			case "messages":
				$this->render( '_messages', [
					'log_id' => $instance->getId()
				] );
				break;
			case "request":
				$this->render( '_request', [
					'instance' => $instance
				] );
				break;
			case "configuration":
				$this->render( '_configuration', [
//					'configuration' => $instance->log['statement']['php_info']
				] );
				break;
			default:
				$this->render( '_messages', [
					'messages' => $instance->getMessageList()->getList()
				] );
				break;
		}


		?>

    </div>


</div>

<?php

/**
 * Class CPS
 */
class CPS
{
	/** @var CPS_Simple */
    private static $_connection;

	/**
	 * @return \CPS_Simple
	 */
	public static function instance()
	{
		if (empty(static::$_connection)) {
			$connectionStrings = array(
				'tcp://cloud-us-0.clusterpoint.com:9007',
				'tcp://cloud-us-1.clusterpoint.com:9007',
				'tcp://cloud-us-2.clusterpoint.com:9007',
				'tcp://cloud-us-3.clusterpoint.com:9007',
			);
			$cpsConn = new CPS_Connection(
				new CPS_LoadBalancer($connectionStrings),
				'hurryapp',
				'developer@ideasmaker.net',
				'island123!',
				'document',
				'//document/id',
				array('account' => 101125));
			//$cpsConn->setDebug(true);	
			$cpsSimple = new CPS_Simple($cpsConn);
			static::$_connection = $cpsSimple;
		}
		return static::$_connection;
	}

	/**
	 * @param $conditions
	 * @param array $options
	 * @return object
	 */
	public static function findOne($type, $conditions = [], $options = [])
	{
		$options = $options + [
			'list' => null,
			'ordering' => null,
			'returnType' => DOC_TYPE_ARRAY,
			'stemlang' => null,
		];
		$query = static::build($type, $conditions);
		$documents = CPS::instance()->search($query, 0, 1, $options['list'], $options['ordering'], $options['returnType'], $options['stemlang']);
		if ($documents) {
			return array_pop($documents);
		}
		return null;
	}

	/**
	 * @param $type
	 * @param $conditions
	 * @param array $options
	 * @return string
	 */
	protected static function build($type, $conditions)
	{
		$query = CPS_Term($type, 'document_type');
		foreach ($conditions as $field => $value) {
			$query .= CPS_Term($value, $field);
		}
		return $query;
	}

	/**
	 * @param string $type
	 * @param $conditions
	 * @param array $options
	 */
	public static function findMany($type, $conditions = [], $options = [])
	{
		$options = $options + [
			'list' => null,
			'ordering' => null,
			'returnType' => DOC_TYPE_ARRAY,
			'stemlang' => null,
			'offset' => 0,
			'docs' => null,
		];
		$query = static::build($type, $conditions);
		$documents = CPS::instance()->search($query, $options['offset'], $options['docs'], $options['list'], $options['ordering'], $options['returnType'], $options['stemlang']);
		return $documents ? array_values($documents) : null;
	}

	/**
	 * @param $data
	 */
	public static function save($data, $type = null)
	{
		if (!isset($data['id'])) {
			$id = uniqid($type . '_');
			$data['document_type'] = $type;
			$method = 'insertSingle';
		} else {
			$id = $data['id'];
			unset($data['id']);
			$method = 'updateSingle';
		}
		$result = CPS::instance()->$method($id, $data);
		if (!$result) {
			return false;
		}
		return $data + ['id' => $id];
	}
}

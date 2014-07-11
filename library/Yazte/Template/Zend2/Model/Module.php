<?php
    $name = $params[0];
    $tableName = $params[1];
?>

/* ----------------------------------------------------------------- */
/*                     Classe Module                                 */
/* ----------------------------------------------------------------- */

use Application\Model\<?=$name ?>;
use Application\Model\<?=$name ?>Table;

class Module {

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Application\Model\<?=$name ?>Table' =>  function($sm) {
                    $tableGateway = $sm->get('<?=$name ?>TableGateway');
                    $table = new <?=$name ?>Table($tableGateway);
                    return $table;
                },
                '<?=$name ?>TableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new <?=$name ?>());
                    return new TableGateway('<?=$tableName ?>', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
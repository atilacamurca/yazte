<?php
    $name = $params[0];
    $tableName = $params[1];
    $elements = $params[2];
    $route = str_replace('_', '-', $tableName);
    $viewName = ucwords(str_replace('_', ' ', $tableName));
?>

<!-- ----------------------------------------------------------------- -->
<!--                     View Index                                    -->
<!-- ----------------------------------------------------------------- -->

&lt;?php
    $this->headScript()->appendFile($this->basePath() . '/js/application/<?=$route ?>/index.js');
?&gt;

<ol class="breadcrumb">
    <li><a href="&lt;?php echo $this->url('home') ?&gt;">Início</a></li>
    <li class="active"><?=$viewName ?></li>
</ol>

<div class="row">
    <div class="col-md-6">
        <h3><?=$viewName ?></h3>
    </div>
    <div class="col-md-6">
        <a href="&lt;?php echo $this->url('<?=$route ?>', array('action' => 'criar')) ?&gt;" class="btn btn-primary btn-lg pull-right">
            <i class="fa fa-plus"></i> Criar <?=$viewName . "\n" ?>
        </a>
    </div>
</div>

<hr/>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
<?php
    foreach($elements as $e):
        $col = new Yazte_Element($e);
?>
                    <td><?=$col->getLabel() ?></td>
<?php
    endforeach;
?>
                    <td style="width: 200px;">&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                &lt;?php foreach ($list as $item): ?&gt;
                <tr>
<?php
    foreach($elements as $e):
        $col = new Yazte_Element($e);
?>
                    <td>&lt;?php echo $item-><?=$col->getColumnName()?> ?&gt;</td>
<?php
    endforeach;
?>
                    <td>
                        <div class="btn-group">
                            <a href="&lt;?php echo $this->url('<?=$route ?>',
                                    array('action' => 'editar', 'id' => $item->id)); ?&gt;"
                               class="btn btn-default"><i class="fa fa-edit"></i> Editar
                            </a>
                            <a href="&lt;?php echo $this->url('<?=$route ?>',
                                    array('action' => 'deletar', 'id' => $item->id)); ?&gt;"
                               class="btn btn-danger deletar">
                                <i class="fa fa-times"></i> Deletar
                            </a>
                        </div>
                    </td>
                </tr>
                &lt;?php endforeach; ?&gt;
            </tbody>
        </table>
    </div>
</div>

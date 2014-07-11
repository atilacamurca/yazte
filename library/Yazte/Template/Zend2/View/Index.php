<?php
    $name = $params[0];
    $tableName = $params[1];
    $elements = $params[2];
?>

<!-- ----------------------------------------------------------------- -->
<!--                     View Index                                    -->
<!-- ----------------------------------------------------------------- -->

&lt;?php
    $this->headScript()->appendFile($this->basePath() . '/js/application/<?=$tableName ?>/index.js');
?&gt;

<ol class="breadcrumb">
    <li><a href="&lt;?php echo $this->url('home') ?&gt;">Início</a></li>
    <li class="active"><?=$name ?></li>
</ol>

<div class="row">
    <div class="col-md-6">
        <h3><?=$name ?></h3>
    </div>
    <div class="col-md-6">
        <a href="&lt;?php echo $this->url('<?=$tableName ?>-criar') ?&gt;" class="btn btn-primary btn-lg pull-right">
            <i class="fa fa-plus"></i> Criar <?=$name . "\n" ?>
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
                            <a href="&lt;?php echo $this->url('<?=$tableName ?>-editar', array('id' => $item->id)); ?&gt;"
                               class="btn btn-default"><i class="fa fa-edit"></i> Editar
                            </a>
                            <a href="&lt;?php echo $this->url('<?=$tableName ?>-deletar', array('id' => $item->id)); ?&gt;"
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

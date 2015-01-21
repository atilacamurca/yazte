<?php
    $name = $params[0];
    $tableName = $params[1];
    $elements = $params[2];
    $route = str_replace('_', '-', $tableName);
    $viewName = ucwords(str_replace('_', ' ', $tableName));
?>

<!-- ----------------------------------------------------------------- -->
<!--                     View Save                                     -->
<!-- ----------------------------------------------------------------- -->

&lt;?php
    $this->headScript()->appendFile($this->basePath() . '/js/application/<?=$route ?>/salvar.js');
?&gt;

<ol class="breadcrumb">
    <li><a href="&lt;?php echo $this->url('home') ?&gt;">Início</a></li>
    <li><a href="&lt;?php echo $this->url('<?=$route ?>') ?&gt;"><?=$viewName ?></a></li>
    <li class="active">&lt;?php echo $title ?&gt;</li>
</ol>

<h4>&lt;?php echo $title ?&gt;</h4><hr/>

&lt;?php
$form->prepare();
echo $this->form()->openTag($form);
?&gt;

<div class="row">
<?php
    foreach($elements as $e):
        $col = new Yazte_Element($e);
        switch ($col->getDataType()):
            case 'int4':
            case 'int8':
                if ($col->isPrimary()):
?>
    <div class="col-sm-2 col-md-2">
        <div class="form-group">
            &lt;?php echo $this->formRow($form->get('<?=$col->getColumnName() ?>')); ?&gt;
        </div>
    </div>
<?php
                elseif ($this->endsWith($col->getColumnName(), "_id")
                            or $this->startsWith($col->getColumnName(), "id_")):
?>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            &lt;?php echo $this->formLabel($form->get('<?=$col->getColumnName() ?>')); ?&gt;
            &lt;?php echo $this->formSelect($form->get('<?=$col->getColumnName() ?>')); ?&gt;
            <div class="form-errors">
                &lt;?php echo $this->formElementErrors($form->get('<?=$col->getColumnName() ?>')); ?&gt;
            </div>
        </div>
    </div>
<?php
                else:
?>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            &lt;?php echo $this->formLabel($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            &lt;?php echo $this->formInput($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            <div class="form-errors">
                &lt;?php echo $this->formElementErrors($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            </div>
        </div>
    </div>
<?php
                endif;
                break;
            case 'varchar':
            case 'timestamp':
            case 'date':
            case 'numeric':
?>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            &lt;?php echo $this->formLabel($form->get('<?=$col->getColumnName() ?>')); ?&gt;
            &lt;?php echo $this->formInput($form->get('<?=$col->getColumnName() ?>')); ?&gt;
            <div class="form-errors">
                &lt;?php echo $this->formElementErrors($form->get('<?=$col->getColumnName() ?>')); ?&gt;
            </div>
        </div>
    </div>
<?php
            break;
            case 'bool':
?>
    <div class="col-sm-2 col-md-2">
        <div class="checkbox">
            <label style="margin-top: 25px;">
                &lt;?php echo $this->formLabel($form->get('<?=$col->getColumnName() ?>')); ?&gt;
                &lt;?php echo $this->formCheckbox($form->get('<?=$col->getColumnName() ?>')); ?&gt;
            </label>
        </div>
    </div>
<?php
            break;
            case 'text':
?>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            &lt;?php echo $this->formLabel($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            &lt;?php echo $this->formTextarea($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            <div class="form-errors">
                &lt;?php echo $this->formElementErrors($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            </div>
        </div>
    </div>
<?php
                break;
            default:
?>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            &lt;?php echo $this->formLabel($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            &lt;?php echo $this->formInput($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            <div class="form-errors">
                &lt;?php echo $this->formElementErrors($form->get('<?= $col->getColumnName() ?>')); ?&gt;
            </div>
        </div>
    </div>
<?php
        endswitch;
    endforeach;
?>
</div>

<div class="row">
    <div class="col-md-6">
        &lt;?php echo $this->formSubmit($form->get('submit')); ?&gt;
    </div>
</div>
&lt;?php
    echo $this->form()->closeTag();
?&gt;

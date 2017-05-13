<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 13.05.17
 * Time: 12:55
 */
?>
@can('task.destroy')
<a class="removetask mr-auto" data-id="{!! $task->id !!}">
    <i class="fa fa-times"></i>
</a>
@endcan


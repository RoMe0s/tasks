<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 10.05.17
 * Time: 0:16
 */
?>
<tr>
    <th scope="row">{!! $real_user->id !!}</th>
    <td>{!! $real_user->name !!}</td>
    <td>{!! $real_user->email !!}</td>
    <td data-id="{!! $real_user->id !!}" data-user_settings>
        <a data-modal_id="userdetails" data-type="edit" class="teal-text" title="@lang('labels.edit')">
            <i class="fa fa-pencil"></i>
        </a>
        <a data-type="password" class="teal-text" title="@lang('labels.change password')" data-modal_id="changepassword">
            <i class="fa fa-refresh"></i>
        </a>
        <a class="red-text" title="@lang('labels.remove')" data-type="delete" data-modal_id="submitremove">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>

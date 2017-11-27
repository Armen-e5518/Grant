<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/23/17
 * Time: 4:31 PM
 */


?>
<div class="left-slide w-100-perc">
    <div class="logo"><a href="/"><img src="/main/assets/images/logo-short.png" alt="" class="w-100-perc"></a></div>
    <ul class="left-slide-menu">
        <li><a href="/" class="d-block prospects <?= $active == 'prospects' ? 'active' : '' ?>  no-underline white-txt"><i class="fa fa-file-text-o"></i>Prospects</a>
        </li>
        <li><a href="/members"
               class="d-block <?= $active == 'members' ? 'active' : '' ?> members no-underline white-txt"><i
                        class="fa fa-users"></i>Members</a>
        </li>
<!--        <li><a href="#" class="d-block reports no-underline white-txt"><i class="fa fa-bar-chart"></i>Reports</a>-->
        </li>
        <li><a href="/countries" class="d-block  <?= $active == 'country' ? 'active' : '' ?> countries no-underline white-txt"><i class="fa fa-globe"></i>Countries</a>
        </li>
    </ul>
    <a href="/projects/create" class="add-new-block  no-underline white-txt"><i></i>Add new prospect</a>
</div>

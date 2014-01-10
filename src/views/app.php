
<div class=row-fluid>
    <div class="span4 offset4">
        <div class="logo"><img title="logo" src="http://placehold.it/250x50"></div>
    </div>
</div>
<div class=row-fluid>
    <div class="span6 offset3 app">
        <button class="btn btn-large btn-block btn-primary add-domain" type="button">Add domain<i class="icon-plus pull-right mgr10"></i></button>
        <ul class="unstyled domains mgt10">
            <?php
                foreach($domains as $domain)
                {
                    echo '<li data-attr-domain="'.$domain['domain'].'">'.$domain['domain'].'</li>';
                }
            ?>
        </ul>
    </div>
</div>
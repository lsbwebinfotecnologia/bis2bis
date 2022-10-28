<div id="content-header">
    <div id="breadcrumb"> 
        {foreach key=K  item=B from=$BREADCRUMBS} 
            <a href="{$B}" class="tip-bottom" data-original-title="Vá para {$K}"><i class="icon-home"></i> {$K}</a> 
        {/foreach}
        
        {if isset($PAGE)}
            <a href="{$PAGE.link}" class="current">{$PAGE.title}</a>
        {/if}

</div>

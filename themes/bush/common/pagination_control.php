<?php if ($this->pageCount > 1): ?>
<div id="pagination-top" class="pagination">
<table class="pagination_list">
    <tr>

    <?php if ($this->first != $this->current): ?>
        <!-- First page link -->
        <td class="pagination_first">
            <a href="<?php echo html_escape($this->url(array('page' => $this->first), null, $_GET)); ?>"><?php echo __('&laquo; First'); ?></a>
        </td>
    <?php endif; ?>

    <?php if (isset($this->previous)): ?>
    <!-- Previous page link -->
    <td class="pagination_previous">
        <a href="<?php echo html_escape($this->url(array('page' => $this->previous), null, $_GET)); ?>"><?php echo __('&laquo; Prev'); ?></a>
    </td>
    <?php endif; ?>

    <!-- Numbered page links -->
    <?php foreach ($this->pagesInRange as $page): ?>
        <?php if ($page != $this->current): ?>
            <td class="pagination_range"><a href="<?php echo html_escape($this->url(array('page' => $page), null, $_GET)); ?>"><?php echo $page; ?></a></td>
        <?php else: ?>
            <td class="pagination_current"><?php echo $page; ?></td>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (isset($this->next)): ?>
    <!-- Next page link -->
    <td class="pagination_next">
        <a href="<?php echo html_escape($this->url(array('page' => $this->next), null, $_GET)); ?>"><?php echo __('Next &raquo;'); ?></a>
    </td>
    <?php endif; ?>

    <?php if ($this->last != $this->current): ?>
    <!-- Last page link -->
    <td class="pagination_last">
        <a href="<?php echo html_escape($this->url(array('page' => $this->last), null, $_GET)); ?>"><?php echo __('Last &raquo;'); ?></a>
    </td>
    <?php endif; ?>
    </tr>
</table>
</div>
<?php endif; ?>

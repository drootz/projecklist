<div class="view-archive th-divider">
<div class="l-wrapper">

    <h2><?= _( 'Project Archive' ); ?></h2>

    <div id="js-form-output" class="m-form-output"></div>
    
    <?php if (isset($projeckts)): ?>
    <form id="delete_projeckt" method="get" action="?" autocomplete="off">
    <table class="m-table">

        <thead>
            <tr>
                <th><?= _('ID'); ?></th>
                <th><?= _('Project Name') ?></th>
                <th><?= _('Last Modified') ?></th>
                <!-- <th colspan="3"><?php // _('Action') ?></th> -->
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>                    
            <?php foreach ($projeckts as $projeckt): ?>
            <tr id="<?= $projeckt["projeckt_id"] ?>">
                <td><?= $projeckt["projeckt_ref"] ?></td>
                <td><?= $projeckt["fld_project_name"] ?></td>
                <td><?= $projeckt["lastmodified_datetime"] ?></td>
                <td class="m-cell-ico">
                    <input class="visuallyhidden js-submit" type="submit" name="send" value="<?= $projeckt["projeckt_id"] ?>" />
                    <span title="<?= _('Send by Email') ?>" class="js-archive-submit fa fa-lg fa-paper-plane" aria-hidden="true"></span>
                </td>
                <td class="m-cell-ico">
                    <a href="projeckt.php?pid=<?= $projeckt["projeckt_id"] ?>&ref=<?= $projeckt["projeckt_ref"] ?>&pname=<?= $projeckt["fld_project_name"] ?>">
                        <span title="<?= _('Edit') ?>" class="fa fa-lg fa-pencil-square-o" aria-hidden="true"></span>
                    </a>
                </td>
                <td class="m-cell-ico">
                    <input class="visuallyhidden js-submit" type="submit" name="delete" value="<?= $projeckt["projeckt_id"] ?>" />
                    <span title="<?= _('Delete') ?>" class="js-archive-delete fa fa-lg fa-trash" aria-hidden="true"></span>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
        
    </table>
    </form>
    <p class="js-table-error is-hidden"><?= _('No project saved yet!'); ?> <a href="projeckt.php"><?= _('Get Started'); ?></a></p>
    <?php endif ?>
    <?php if (!isset($projeckts)): ?>
        <p><?= _('No project saved yet!'); ?> <a href="projeckt.php"><?= _('Get Started'); ?></a></p>
    <?php endif ?>
</div>
</div>
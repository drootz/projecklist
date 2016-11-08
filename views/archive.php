<div class="view-archive th-divider">
<div class="l-wrapper">

    <h2><?= _( 'Projeckt Archive' ); ?></h2>

    <div id="js-form-output" class="m-form-output"></div>
    
    <?php if (isset($projeckts)): ?>
    <form id="delete_projeckt" method="get" action="?" autocomplete="off">
    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Projeckt Name</th>
                <th>Last Modified</th>
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
                <td><span class="js-archive-delete fa fa-lg fa-download" aria-hidden="true"></span></td>
                <td><a href="projeckt.php?pid=<?= $projeckt["projeckt_id"] ?>&ref=<?= $projeckt["projeckt_ref"] ?>&pname=<?= $projeckt["fld_project_name"] ?>"><span class="js-archive-delete fa fa-lg fa-pencil-square-o" aria-hidden="true"></span></a></td>
                <td>
                    <input class="visuallyhidden js-submit" type="submit" name="delete" value="<?= $projeckt["projeckt_id"] ?>" />
                    <!-- <span class="js-archive-delete">Delete</span> -->
                    <span class="js-archive-delete fa fa-lg fa-trash" aria-hidden="true"></span>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
        
    </table>
    </form>
    <?php endif ?>
    <?php if (!isset($projeckts)): ?>
        <p>No projeckt saved yet! <a href="projeckt.php">Get Started</a></p>
    <?php endif ?>
</div>
</div>
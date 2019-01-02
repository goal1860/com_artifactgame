<header class="container-fluid bg-light mb-3">
    <div>
        <h1 class="h4 py-2 mb-0  float-left">Deck List</h1>

        <a "type="button" class="ag-button btn-primary float-right" href="/deck-builder">
            <i class="fa fa-plus"></i> Create New
        </a>

    </div>
</header>
<div class="row">
    <div class="col-xs-12">
        <div id="deckList" class="card border-secondary mb-3 align-content-center">

            <div id="deckSearchResults_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="m-2">
                    <table id="deckSearchResults"
                           class="table table-striped table-bordered table-sm dt-responsive nowrap dataTable no-footer dtr-inline"
                           style="width: 100%;" role="grid" aria-describedby="deckSearchResults_info">
                        <thead>
                        <tr role="row">
                            <th scope="col" width="40%" class="sorting_asc" tabindex="0"
                                aria-controls="deckSearchResults" rowspan="1" colspan="1" style="width: 304.2px;"
                                aria-label="Name: activate to sort column descending" aria-sort="ascending">Name
                            </th>

                            <th scope="col" width="20%" class="sorting" tabindex="0" aria-controls="deckSearchResults"
                                rowspan="1" colspan="1" style="width: 123.2px;"
                                aria-label="Format: activate to sort column ascending">Format
                            </th>
                            <th scope="col" width="20%" class="sorting" tabindex="0" aria-controls="deckSearchResults"
                                rowspan="1" colspan="1" style="width: 123.2px;"
                                aria-label="Format: activate to sort column ascending">Author
                            </th>
                            <th scope="col" width="15%" class="sorting" tabindex="0" aria-controls="deckSearchResults"
                                rowspan="1" colspan="1" style="width: 127.2px;"
                                aria-label="Last Update: activate to sort column ascending">Last Update
                            </th>
                            <th scope="col" width="5%" class="sorting" tabindex="0" aria-controls="deckSearchResults"
                                rowspan="1" colspan="1" style="width: 55.2px;"
                                aria-label="Upvotes: activate to sort column ascending">Upvotes
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->decklist as $deck) {
                            if ($deck->published || $deck->editable) {

                                ?>
                                <tr<?php if (!$deck->published) {
                                    echo "class=\"bg-danger\"";
                                } ?>>
                                    <td class="sorting_1" tabindex="0"><a href="<?php
                                        echo JRoute::_('index.php?option=com_artifactgame&view=details&id=' . $deck->deckCode, false);
                                        ?>">
                                            <?php echo $deck->name ?>
                                            <?php
                                            if (!$deck->published) {
                                                echo " (unpublished) ";
                                            }
                                            ?>
                                        </a> <?php
                                        if ($deck->editable) {
                                            ?>
                                            <a class="fa fa-edit"
                                               href="/deck-builder?id=<?php echo $deck->deckCode ?>"/>
                                            <?php
                                        }
                                        ?></td>
                                    <td style=""><?php echo $deck->format ?></td>
                                    <td style=""><?php echo $deck->author ?></td>
                                    <td style=""><?php echo $deck->last_updated ?></td>
                                    <td style=""><?php echo $deck->upvotes ?></td>
                                </tr>
                                <?php
                            }
                        } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
<script>
    $('form').trigger("reset");
    const table = $('#deckSearchResults').DataTable({
        'lengthChange': false,
    });
    const deckListSearch = [0, 1];
    $('#checkName').on('change', function () {
        console.log($('#checkName').is(':checked'));
        if ($('#checkName').is(':checked')) {
            deckListSearch.push(0);
        } else {
            deckListSearch.splice(deckListSearch.indexOf(0), 1);
        }
    });
    $('#checkDesc').on('change', function () {
        if ($('#checkDesc').is(':checked')) {
            deckListSearch.push(1);
        } else {
            deckListSearch.splice(deckListSearch.indexOf(1), 1);
        }
    });
    $('#deck-list-text').on('keyup', function () {
        multiSearch(table, deckListSearch, $('#deck-list-text').val());
    });
    const colors = ['red', 'green', 'blue', 'black'];
    $('.color-deck').on('change', function () {
        const color = $(this).attr('id');
        console.log(color);
        if ($('#' + color).is(':checked')) {
            colors.push(color);
        } else {
            const index = colors.indexOf(color)
            colors.splice(index, 1);
        }
        var search;
        if (colors.length > 0) {
            search = colors.toString().split(',').join('|');
        } else {
            search = null;
        }
        console.log(search);
        table.column(3)
            .search(search, true, false)
            .draw();
    });
</script>
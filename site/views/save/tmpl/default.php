<div class="row">
    <div class="col-xs-12 col-lg-8 order-2 order-lg-1">
        <div id="deckList" class="card border-secondary mb-3 align-content-center">
            <div class="card-header">
                <h1 class="h5 mt-2 float-left">Deck Results</h1>
            </div>
            <div id="deckSearchResults_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="m-2">
                    <table id="deckSearchResults"
                           class="table table-striped table-bordered table-sm dt-responsive nowrap dataTable no-footer dtr-inline"
                           style="width: 100%;" role="grid" aria-describedby="deckSearchResults_info">
                        <thead>
                        <tr role="row">
                            <th scope="col" width="60%" class="sorting_asc" tabindex="0"
                                aria-controls="deckSearchResults" rowspan="1" colspan="1" style="width: 304.2px;"
                                aria-label="Name: activate to sort column descending" aria-sort="ascending">Name
                            </th>
                            <th scope="col" width="20%" class="sorting" tabindex="0" aria-controls="deckSearchResults"
                                rowspan="1" colspan="1" style="width: 123.2px;"
                                aria-label="Format: activate to sort column ascending">Format
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
<?php foreach ($this->decklist as $deck) { ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1" tabindex="0"><img class="mr-2 colorcode"
                                                                    src="/data/img/colors/10.png"><a href="<?php
                                echo JRoute::_('index.php?option=com_artifactgame&view=details', false);
                                ?>">
                                    <?php echo $deck->name ?>
                                </a></td>
                            <td style="">Unconfirmed Ruleset</td>
                            <td style="">2018-04-02 22:56:45</td>
                            <td style="">1</td>
                        </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xs-12 col-lg-4 order-1 order-lg-2">
        <div class="card border-secondary mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item active">Search Criteria
                    </li>
                </ul>
            </div>
            <div id="seachTabs" class="tab-content">
                <div id="tabSimpleDeck" class="card-body tab-pane active show">
                    <form id="simpleSearchDeck">
                        <input type="hidden" name="subject" value="simpleSearchDeck">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Text</label>
                            <input type="text" name="text" id="name" class="form-control mr-2">
                        </div>
                        <div class="form-group">
                            <div><label for="name" class="font-weight-bold mt-1">Include:</label></div>
                            <div class="form-check mr-2">
                                <input id="checkName" name="findName" class="form-check-input" type="checkbox"
                                       checked="">
                                <label for="checkName" class="form-check-label">
                                    Name
                                </label>
                            </div>
                            <div class="form-check">
                                <input id="checkSkill" name="findText" class="form-check-input" type="checkbox"
                                       checked="">
                                <label for="checkSkill" class="form-check-label">
                                    Description
                                </label>
                            </div>
                        </div>
                        <div class="form-group float-left">
                            <div><label class="font-weight-bold">Color:</label></div>
                            <div class="form-check">
                                <input id="black" name="color[]" value="3" class="form-check-input" type="checkbox"
                                       checked="">
                                <label for="black" class="form-check-label  deck-black">
                                    Black
                                </label>
                            </div>
                            <div class="form-check">
                                <input id="blue" name="color[]" value="5" class="form-check-input" type="checkbox"
                                       checked="">
                                <label for="blue" class="form-check-label deck-blue">
                                    Blue
                                </label>
                            </div>
                            <div class="form-check">
                                <input id="green" name="color[]" value="4" class="form-check-input" type="checkbox"
                                       checked="">
                                <label for="green" class="form-check-label deck-green">
                                    Green
                                </label>
                            </div>
                            <div class="form-check">
                                <input id="red" name="color[]" value="2" class="form-check-input" type="checkbox"
                                       checked="">
                                <label for="red" class="form-check-label align-cont deck-red">
                                    Red
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input id="exclude" name="exclude" class="form-check-input" type="checkbox">
                                <label for="exclude" class="form-check-label align-cont">
                                    Exclude unselected
                                </label>
                            </div>
                            <div class="form-check">
                                <input id="and" name="and" class="form-check-input" type="checkbox">
                                <label for="and" class="form-check-label align-cont">
                                    Use AND operation
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                        <button id="resetSimpleDeck" class="btn btn-danger btn-block">Reset</button>
                    </form>
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